<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // =========================
    // LIST USER
    // =========================
    public function index()
    {
        $users = User::where('is_deleted', 0)->latest()->get();

        return view('superadmin.index', compact('users'));
    }


    // =========================
    // FORM TAMBAH USER
    // =========================
    public function create()
    {
        return view('superadmin.create');
    }


    // =========================
    // SIMPAN USER
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:users,name',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'is_deleted' => 0,
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil ditambahkan');
    }


    // =========================
    // FORM EDIT USER
    // =========================
    public function edit($id)
    {
        $user = User::where('is_deleted', 0)->findOrFail($id);

        return view('superadmin.edit', compact('user'));
    }


    // =========================
    // UPDATE USER
    // =========================
    public function update(Request $request, $id)
    {
        $user = User::where('is_deleted', 0)->findOrFail($id);

        $request->validate([
            'name' => 'required|unique:users,name,' . $user->id,
            'role' => 'required',
            'password' => 'nullable|confirmed|min:6',
        ]);

        $data = [
            'name' => $request->name,
            'role' => $request->role,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect()
            ->route('users.index')
            ->with('success', 'Data user berhasil diupdate');
    }


    // =========================
    // HAPUS USER
    // =========================
    public function destroy($id)
    {
        $user = User::where('is_deleted', 0)->findOrFail($id);

        // cegah hapus akun sendiri
        if ($user->id == auth()->id()) {
            return back()->with(
                'error',
                'Tidak bisa menghapus akun sendiri'
            );
        }

        $user->update([
            'is_deleted' => 1
        ]);

        return back()->with(
            'success',
            'User berhasil dinonaktifkan'
        );
    }
}
