<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('profile',compact('user'));
    }

    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (!$user->status && Auth::id() == $user->id) {
            return redirect()->route('profile')->with('error', 'Your account is inactive, and you cannot update your profile.');
        }

        if (Auth::user()->utype !== 'admin' && Auth::id() !== $user->id) {
            return redirect()->route('profile')->with('error', 'You are not authorized to edit this user.');
        }

        return view('updateProfile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate photo
        ]);

        // إذا كان المستخدم العادي يحاول تعديل غير بياناته، نعيد توجيهه مع رسالة خطأ
        if (Auth::user()->utype !== 'admin' && Auth::id() !== $user->id) {
            return redirect()->route('profile')->with('error', 'You are not authorized to update this user.');
        }

        $user->name = $request->input('name');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->input('password'));
        }

        // Handle the photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo) {
                Storage::delete($user->photo);
            }

            // Store the new photo
            $path = $request->file('photo')->store('photos', 'public'); // Store in 'public/photos' directory
            $user->photo = $path; // Update user photo path
        }

        $user->save();

        if (Auth::user()->utype === 'admin') {
            return redirect()->route('admin.users')->with('success', 'User updated successfully.'); // تأكد من أن لديك هذا المسار
        } else {
            return redirect()->route('profile')->with('success', 'Profile updated successfully.');
        }
    }

}
