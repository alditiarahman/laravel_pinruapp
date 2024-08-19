<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate();

        return view('users.index', compact('users'));
    }

    public function makeAdmin(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->syncRoles('admin');
        return redirect()->back()->with('success', 'User role updated successfully.');
    }

    public function makeOperator(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->syncRoles('operator');
        return redirect()->back()->with('success', 'User role updated successfully.');
    }

    public function makePeminjam(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->syncRoles('peminjam');
        return redirect()->back()->with('success', 'User role updated successfully.');
    }
}
