<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->input('email');
        $password = $request->input('password');

        // Find user by email and role = admin
        $user = User::where('email', $email)
                    ->where('role', 'admin')
                    ->first();

        if ($user && Hash::check($password, $user->password)) {
            // Login success (you might want to implement session/auth here)
            return redirect()->route('admin.editquiz');
        }

        // Login failed
        return redirect()->route('admin.login.form')->with('error', 'Invalid credentials or not an admin.');
    }

    public function editquiz()
    {
        return view('editquiz');
    }

    public function addAdminUser()
    {
        $user = User::create([
            'name' => 'Neo',
            'email' => 'Neo@email.com',
            'password' => Hash::make('neo123#'),
            'role' => 'admin',
        ]);

        return 'Admin user created with id: ' . $user->id;
    }
}
