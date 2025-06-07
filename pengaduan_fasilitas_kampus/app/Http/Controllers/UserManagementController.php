<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    // Middleware bisa ditambahkan supaya hanya admin yang akses
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('can:manage-users'); // contoh middleware hak akses
    }

    public function index()
    {
        $users = User::orderBy('name')->paginate(10);
        return view('user_management.index', compact('users'));
    }

    public function create()
    {
        $roles = ['admin', 'petugas', 'mahasiswa'];
        return view('user_management.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'username'    => 'required|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
            'role'     => ['required', Rule::in(['admin', 'petugas', 'mahasiswa'])],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function show(User $user)
    {
        return view('user_management.show', compact('user'));
    }

    public function edit(User $user)
    {
        if ($user->role == "mahasiswa") {
            abort(403, "Role Mahasiswa Tidak Bisa Diedit");
        }

        $roles = ['admin', 'petugas', 'mahasiswa'];
        return view('user_management.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name'  => 'required|string|max:255',
            'username' => ['required', Rule::unique('users')->ignore($user->id)],
            'role'  => ['required', Rule::in(['admin', 'petugas', 'mahasiswa'])],
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
