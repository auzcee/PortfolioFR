<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController
{
    public function index(Request $request): View
    {
        $query = User::where('role', 'user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function show(User $user): View
    {
        return view('admin.users.show', compact('user'));
    }

    public function suspend(User $user)
    {
        $user->update(['is_active' => false]);

        return back()->with('success', "{$user->name} has been suspended.");
    }

    public function activate(User $user)
    {
        $user->update(['is_active' => true]);

        return back()->with('success', "{$user->name} has been activated.");
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', "{$user->name} has been deleted.");
    }
}
