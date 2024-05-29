<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Foundation\Http\FormRequest;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request , String $id): View
    {
        $user = User::findOrFail(Crypt::decrypt($id));
        return view('profile.edit')->with('user' , $user);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, String $id)
    {
        $user = User::findOrFail(Crypt::decrypt($id));
    
        $rules = $request->rules();
        $rules['email'] = ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)];
        $rules['avatar'] = ['nullable' , 'file', 'mimes:jpeg,png,jpg,gif', 'max:2000'];
        $validatedData = $request->validate($rules);
    
        $user->fill($validatedData);
    
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
    
        if ($avatarName = $this->storeAvatar($request)) {
            $user->avatar = $avatarName;
        }
        $user->isUpdated = true;
    
        $user->save();
    
        return redirect()->back()->with('status', 'profile-updated');
    }

    private function storeAvatar(Request $request)
    {
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $directory = '/avatars';
            $fileName = uniqid() . '_' . $file->getClientOriginalName();
            $file->storeAs($directory, $fileName, 'public');
            return $fileName;
        }else{
            return null;
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
}
