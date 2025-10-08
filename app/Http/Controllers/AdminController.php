<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.dashboard', compact('users'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('pengguna')->with('success', 'User berhasil dihapus.');
    }

    
    public function addUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|',
            'role' => 'required|string|in:admin,bendahara',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('pengguna')->with('success', 'User berhasil ditambahkan.');
    }
}

