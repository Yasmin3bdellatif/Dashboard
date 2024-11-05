<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // عرض جميع المستخدمين الذين ليس لديهم صفة "أدمن"
    public function index()
    {
        $users = User::where('utype', 'user')->get();
        return view('dashboard', compact('users'));
    }

    // تغيير حالة المستخدم (تفعيل/تعطيل)
    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = !$user->status; // عكس حالة المستخدم
        $user->save();

        return redirect()->route('admin.users')->with('success', 'User status has been changed');
    }

    // حذف المستخدم
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }

    // عرض ملف تعريف الأدمن
    public function showProfile()
    {
        $user = auth()->user();
        return view('profile', compact('user'));
    }

    public function createUser()
    {
        return view('addUser');
    }

    public function addUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'utype' => 'user',
            'status' => false
        ]);
        //Auth::login($user);

        return redirect()->route('admin.users');
    }

}
