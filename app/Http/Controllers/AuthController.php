<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Notifications\VerifyEmail;


class AuthController extends Controller
{


    public function register(Request $request)
    {
        // Validate the incoming request data
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email', // Ensure email is unique in the users table
            'password' => 'required|min:8|confirmed' // Use confirmed rule to check for password confirmation
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'utype' => 'user',
            'status' => false,
          //  'code' => rand(100000, 999999),
        ]);

        Auth::login($user);
        return redirect()->route('profile')->with('success', 'Registration successful! .');
    }

    // Login an existing user
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);


        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();

            // تحقق من نوع المستخدم (utype) للتوجيه
            if ($user->utype === 'admin') {
                return redirect()->route('admin.users');
            } else {
                return redirect()->route('profile');
            }
        }

        return back()->withErrors(['email' => 'Your email or password is incorrect.']);
    }

    // Logout the authenticated user
    public function logout()
    {
        Auth::logout(); // Log the user out
        return redirect()->route('login'); // Redirect to the login page
    }
}
