<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index(Request $req)
    {
        $q = $req->query('q');
        $users = User::when($q, fn($qb) => $qb->where('name', 'like', '%' . $q . '%')->orWhere('email', 'like', '%' . $q . '%'))
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.user.index', compact('users', 'q'));
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $req, User $user)
    {
        $data = $req->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'is_admin' => 'nullable|boolean',
            'blocked' => 'nullable|boolean'
        ]);
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'is_admin' => $req->has('is_admin') ? (bool) $req->is_admin : $user->is_admin,
            'blocked' => $req->has('blocked') ? (bool) $req->blocked : $user->blocked,
        ]);
        return redirect()->route('admin.users.index')->with('success', 'User updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted');
    }
}
