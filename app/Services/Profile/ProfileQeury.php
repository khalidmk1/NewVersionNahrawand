<?php

namespace App\Services\profile;


use App\Models\User;
use App\Models\SubCategory;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\UserSubcategory;
use App\Services\GlobaleService;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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

    public function allClient(){
        $clients = User::role('client')->get();
        return $clients;
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

        if ($request->has('role')) {
            $roles = Role::whereIn('name', $request->role)->get();
            $user->syncRoles($roles);
        } else {
            $role = Role::where('name', 'Admin')->firstOrFail();
            $user->assignRole($role);
        }

        return $user;
    }


    //api for profile user
    public function authClient(){
        $authClient = Auth::user();

        return response()->json([
            $authClient
        ]);

    }

    public function populaireUsers(){
        $users = User::where('isPopular' , 1)
        ->with('roles')
        ->get();
        $filteredUsers = $users->map(function($user){
            $roleNames = $user->roles->pluck('name')->toArray();
            return [
                'avatar' => $user->avatar,
                'cover' => $user->cover,
                'fullName' => $user->firstName . ' ' . $user->lastName,
                'biographie' => $user->biographie,
                'faceboock' => $user->faceboock,
                'linkdin' => $user->linkdin,
                'instagram' => $user->instagram,
                'roles' => $roleNames,
            ];
        });

        return $filteredUsers;
    }

    public function updateClientApi(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'firstName' => ['string', 'max:255'],
            'lastName' => ['string', 'max:255'],
            'status' => ['string', 'max:255'],
            'numChild' => ['integer'],
            'profission' => ['string', 'max:255'],
            'email' => ['email', 'unique:users,email,' . $user->id],
        ]);

        $user->update([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'dateBirt' => $request->date_birte,
            'status_matrimonial' => $request->status,
            'numChild' => $request->numchild,
            'profission' => $request->profission,
        ]);
        return $user;
    }

    public function updateClientAvatarApi(Request $request)
    {
        if ($request->has('avatar')) {
            $avatarData = $request->input('avatar');

            $avatarData = preg_replace('/^data:image\/(png|jpeg|jpg);base64,/', '', $avatarData);

            $avatarImage = base64_decode($avatarData);

            $fileName = 'avatar_' . Str::uuid() . '.png';
            Storage::disk('public')->put('avatars/' . $fileName, $avatarImage);

            $user = $request->user();
            if ($user->avatar) {
                Storage::disk('public')->delete('avatars/' . $user->avatar);
            }

            $user->update([
                'avatar' => $fileName,
            ]);

            return response()->json([
                'message' => 'Avatar updated successfully.',
                'avatar' => $fileName,
            ], 200);
        }

        return response()->json([
            'message' => 'No avatar provided.',
        ], 400);
    }

    public function createUserSubCategoryApi(String $subCategoryId){

        $subCategory = SubCategory::findOrFail($subCategoryId);

        $userSubCategoryExists = UserSubcategory::where('subCategoryId' , $subCategory->id)
        ->where('userId' , Auth::user()->id)
        ->exists();

        if(!$userSubCategoryExists){
            $userSubCategory = UserSubcategory::create([
                'userId' => Auth::user()->id,
                'subCategoryId' => $subCategory->id,
            ]);

            return $userSubCategory;
        }else{
            $userSubCategory = UserSubcategory::where('subCategoryId' , $subCategory->id)
            ->where('userId' , Auth::user()->id)
            ->delete();

            return $userSubCategory;
        }

    } 

    public function allUserSubcatagoryApi(){
        $userSubCategory = UserSubcategory::where('userId' , Auth::user()->id);
        return $userSubCategory;
    }

}

