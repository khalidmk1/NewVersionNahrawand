<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\ProfileUpdateRequest;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $roles = Role::all();

        return view('auth.register')->with('roles' , $roles);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(ProfileUpdateRequest $request): RedirectResponse
    {

       
        $rules = $request->rules();
        $rules['email'] = ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class];
        $rules['password'] = ['required', 'confirmed', Rules\Password::defaults()];

        /* dd($request); */
        $role = Role::where('name', 'Super Admin')->firstOrFail();

        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'isLogin' => true,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $user->assignRole($role);
       
        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
