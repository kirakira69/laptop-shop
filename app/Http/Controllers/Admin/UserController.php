<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        // Get all users except the current admin (so you don't disable yourself)
        $users = User::where('id', '!=', auth()->id())->latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function toggleStatus($id)
    {
        $user = User::findOrFail($id);

        // Toggle logic
        if ($user->status === 'active') {
            $user->status = 'disabled';
            $message = 'User account has been disabled.';
        } else {
            $user->status = 'active';
            $message = 'User account has been reactivated.';
        }

        $user->save();

        return redirect()->back()->with('success', $message);
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.show', compact('user'));
    }
}
