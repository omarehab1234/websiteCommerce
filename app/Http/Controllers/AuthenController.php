<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class AuthenController extends Controller
{
    function showLogin(){
        return view("auth.login");
    }
    function showRegister(){
        return view("auth.register");
    }
    
    function validateRegister(Request $request){

        $validated = $request->validate([
            // here validation 
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'confirmed',
                // this is a password class for validation
                Password::min(8)
                ->letters()
                ->mixedCase()
                ->numbers()
                ->symbols(),
            ],
        ],[
            // what to send for every error
            'name.min' => 'name contain atleast 3 letters',
            'email.unique'=>'email is already in use',
            'password.confirmed' => 'Passwords do not match.',
            'password.regex' => 'Password must contain uppercase, lowercase, number and special character.',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('login')
            ->with('success', 'Account created successfully!');
    }

    function validateLogin(Request $req)
    {
        $validated = $req->validate([
            'email' => 'required|email',
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return back()->withErrors([
                'email' => 'Invalid email or password.',
            ])->withInput();
        }

        Auth::login($user);

        return redirect()->route("home");
    }

    //Logout
    function destroy(Request $request){
        Auth::logout();
        // remove session
        $request->session()->invalidate();
        // generate new token to prevent session fixation attack
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
