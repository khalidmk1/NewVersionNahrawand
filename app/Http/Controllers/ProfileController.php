<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use App\Interfaces\ProfileInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Foundation\Http\FormRequest;

class ProfileController extends Controller
{
    private $ProfileInterface;

    public function __construct(ProfileInterface $ProfileInterface) {
        $this->ProfileInterface = $ProfileInterface;
    }


    public function show(String $id){
        return $this->ProfileInterface->showClient($id);
    }


    /**
     * Display the user's profile form.
     */
    public function edit(Request $request , String $id): View
    {
        $user = User::findOrFail(Crypt::decrypt($id));
        $rolesSpeakers = $this->ProfileInterface->speakersAllRole();
        $rolesMangers = $this->ProfileInterface->mangerAllRole();
        $rolesAdmin = $this->ProfileInterface->adminAllRole();
        $rolesSuperAdmin = $this->ProfileInterface->superAdminRole();
        return view('profile.edit')->with(['user' => $user , 'rolesSpeakers' => $rolesSpeakers , 
        'rolesMangers' => $rolesMangers , 'rolesAdmin' => $rolesAdmin , 'rolesSuperAdmin' => $rolesSuperAdmin]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, String $id)
    {
        $user = User::findOrFail(Crypt::decrypt($id));
    
        $rules = $request->rules();
        $rules['email'] = ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)];
        $rules['avatar'] = ['nullable', 'file', 'mimes:jpeg,png,jpg,gif', 'max:2000'];
        $rules['cover'] = ['nullable', 'file', 'mimes:jpeg,png,jpg,gif', 'max:2000'];
    
        // Handle password validation if it's set
        if ($request->filled('password')) {
            $rules['password'] = ['nullable', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()];
        }
    
        $validatedData = $request->validate($rules);
    
        $user->fill([
            'firstName' => $validatedData['firstName'],
            'lastName' => $validatedData['lastName'],
            'biographie' => $validatedData['biographie'] ?? $user->biographie,
            'facebook' => $validatedData['facebook'] ?? $user->facebook,
            'linkedin' => $validatedData['linkedin'] ?? $user->linkedin,
            'instagram' => $validatedData['instagram'] ?? $user->instagram,
            'email' => $validatedData['email'],
            'isPopular' => $request->boolean('isPopular', $user->isPopular),
        ]);
    
        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
    
        if ($request->has('avatar')) {
            $avatarName = $this->updateAvatar($request, $user->avatar);
            $user->avatar = $avatarName;
        }
    
        if ($request->has('cover')) {
            $coverName = $this->updateCover($request, $user->cover);
            $user->cover = $coverName;
        }
    
        $user->isUpdated = true;
    
        // Sync roles
        if ($request->has('role') && !empty($request->role)) {
            $roles = Role::whereIn('name', $validatedData['role'])->get();
            $user->syncRoles($roles);
        } else {
            $user->syncRoles($user->roles->pluck('name')->toArray());
        }
    
        $user->save();
    
        return redirect()->back()->with('status', 'profile-updated');
    }
    

    


    private function updateAvatar(ProfileUpdateRequest $request , String $nameAvatar)
    {
        if ($request->hasFile('avatar')) {
            $imagePath = 'avatar/'.$nameAvatar;
            Storage::disk('public')->delete($imagePath);

            $file = $request->file('avatar');
            $directory = '/avatars';
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileName, 'public');
            return $fileName;
        }else{
            return $nameAvatar;
        }
    }
    private function updateCover(ProfileUpdateRequest $request , String $nameCover)
    {
        if ($request->hasFile('cover')) {
            $imagePath = 'cover/'.$nameCover;
            Storage::disk('public')->delete($imagePath);

            $file = $request->file('cover');
            $directory = '/cover';
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileName, 'public');
            return $fileName;
        }else{
            return $nameCover;
        }
    }



    /**
     * Delete the user's account.
     */
    public function destroy(Request $request , String $id)
    {

        $user = User::findOrFail(Crypt::decrypt($id));

        $request->validate([
            'password' => ['required' ,  'current_password']
        ]);

        if(Hash::check( $request->password, Auth::user()->password ))
        {
            $user->delete();
        }

       
        return redirect()->back()->with('status' , 'You Delete Profile');
    }

    public function restore(String $userId){
        return $this->ProfileInterface->restore($userId);
    }
}
