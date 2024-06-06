<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function storeApi(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
       

        if (Auth::attempt($request->only('email', 'password'))) {

            $user = Auth::user();
            $user->update([
                'isLogin' => 1
            ]);
            $token = $user->createToken($user->email)->plainTextToken;

            
            return response()->json(['user' => $user, 'token' => $token]);
        }
    
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroyApi(Request $request)
    {
       
       $user = $request->user();

       $user->tokens()->delete();
        
       $user->update([
           'isLogin' => 0,
       ]);

       return response()->json(['message' => 'Logged out successfully']);

    }
}
