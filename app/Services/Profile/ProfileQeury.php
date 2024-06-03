<?php

namespace App\Services\profile;


use App\Models\User;
use Illuminate\Support\Str;
use App\Services\GlobaleService;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Http\Requests\ProfileUpdateRequest;


class ProfileQeury extends GlobaleService {

    public function userId(String $id){
        $user = User::findOrFail(Crypt::decrypt($id));

        return $user;
    }

    public function allAdmins(){
        $adminRole = Role::where('name', 'admin')->first();
        $adminUsers = User::whereHas('roles', function($query) use ($adminRole) {
            $query->where('role_id', $adminRole->id);
        })->paginate(10);

        return $adminUsers;
    }

    public function allManagers(){
        
        $excludedRoles = ['Super Admin', 'client' , 'Admin', 'Formateur', 'Invité', 'Modérateur', 'Conférencier', 'Animateur'];
        $managerRoles = Role::whereNotIn('name', $excludedRoles)->get();
        $managerRoleIds = $managerRoles->pluck('id')->toArray();
        $managerUsers = User::whereHas('roles', function ($query) use ($managerRoleIds) {
            $query->whereIn('role_id', $managerRoleIds);
        })->paginate(10);
        return $managerUsers;
    }


    public function allSpeakers(){
        
        $excludedRoles = ['Formateur', 'Invité', 'Modérateur', 'Conférencier', 'Animateur'];
        $speakerRoles = Role::whereIn('name', $excludedRoles)->get();
        $speakerRoleIds = $speakerRoles->pluck('id')->toArray();
        $SpeakerUsers = User::whereHas('roles', function ($query) use ($speakerRoleIds) {
            $query->whereIn('role_id', $speakerRoleIds);
        })->paginate(10);
        return $SpeakerUsers;
    }

    public function allRoleManagers()
    {
        $excludedRoles = ['Super Admin', 'Admin', 'Formateur', 'Invité', 
        'Modérateur', 'Conférencier', 'Animateur' , 'Client'];
        $managerRoles = Role::whereNotIn('name', $excludedRoles)->get();
        return $managerRoles;
    }

    public function allRoleSpeaker(){
        $includedRoles = ['Formateur', 'Invité', 'Modérateur', 'Conférencier', 'Animateur'];
        $speakerRole = Role::whereIn('name', $includedRoles)->get();

        return $speakerRole;
    }

   



    public function storeAdmin(ProfileUpdateRequest $request){

        $rules = $request->rules();
        $rules['email'] = ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class];
        $rules['password'] = ['nullable', 'confirmed', Password::defaults()];
        $rules['avatar'] = ['required' , 'file', 'mimes:jpeg,png,jpg,gif', 'max:2000'];
        if($request->has('roleSpeaker')){
            $rules['cover'] = ['required' , 'file', 'mimes:jpeg,png,jpg,gif', 'max:2000'];
        }  
        $validatedData = $request->validate($rules);
        $avatarName =  $this->storeAvatar($request);
        $coverName = $this->storeCover($request);

        $role = Role::where('name', 'Admin')->firstOrFail(); 
        $roleGuest = Role::where('name' , $request->role)->firstOrFail();
        
        if (empty($request->password)) {
            $password = Str::random(8);
        } else {
            $password = $request->password;
        }
        $hashedPassword = Hash::make($password);
        $isPopulaire = $request->isPopulaire == 'on';
        $user= User::create([
            'avatar' => $avatarName,
            'cover' => $coverName,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'isPopular' => $isPopulaire,
            'biographie' => $request->biographie,
            'faceboock' => $request->facebook,
            'linkdin' => $request->linkedin,
            'instagram' => $request->instagram,
            'email' => $request->email,
            'password' => $hashedPassword
        ]);

        if($request->has('role')){
            $user->assignRole($roleGuest);
        }else{
            $user->assignRole($role);
        }

       

        return $user;

    }

}
