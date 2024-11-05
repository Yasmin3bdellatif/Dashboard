<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyController extends Controller
{
    public function verifyCode(Request $request)
    {
        // Validate the incoming request data
        $this->validate($request, [
            'code' => 'required|string',
        ]);

        // Find the user by the verification code
        $user = User::where('code', $request->code)->first();

        if ($user) {
            // If the user is found, update their status to active
            $user->code = null;
            $user->save();

            // Log the user in
            Auth::login($user);

            return redirect()->route('profile')->with('success', 'Your account checked !'); // Redirect to the dashboard
        }

        return redirect()->back()->with('error', 'Try again'); // Redirect back with an error
    }
}
