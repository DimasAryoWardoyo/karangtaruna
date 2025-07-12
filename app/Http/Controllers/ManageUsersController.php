<?php

namespace App\Http\Controllers;

use App\Models\Identitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class ManageUsersController extends Controller
{
    // ============================ Personal Profile ============================
    public function editProfile()
    {
        return view('manageUser.personal.edit-profile', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = $request->password;
        }

        $user->save();

        // bisa juga di gunakan pada ProfileController
        $redirectRoute = auth()->user()->role === 'admin' ? 'profile.index' : 'anggota.profile.index';

        return redirect()->route($redirectRoute)->with('success', 'Profil berhasil diperbarui');
    }
    // ============================ endPersonal Profile ============================

    // ============================ Manage Users ============================
    public function index()
    {
        $users = User::all();
        return view('manageUser.index', compact('users'));
    }

    // ------------------------ Buat User (form user) ------------------------
    public function create()
    {
        return view('manageUser.create');
    }

    // ------------------------ up ke database user ------------------------
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,anggota',
            'password' => 'required|min:6|confirmed',
            'no_whatsapp' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'status' => 'required|in:aktif,tidak',
            'alasan' => 'nullable|in:sekolah di luar kota,bekerja di luar kota',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        Identitas::create([
            'user_id' => $user->id,
            'no_whatsapp' => $request->no_whatsapp,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status' => $request->status,
            'alasan' => $request->alasan,
        ]);

        return redirect()->route('manageUsers.index')->with('success', 'User baru berhasil ditambahkan');
    }

    // ------------------------ Edit User (form edit user) ------------------------
    public function edit($id)
    {
        $user = User::with('identitas')->findOrFail($id);
        return view('manageUser.edit', compact('user'));
    }

    // ------------------------ up ke database user untuk edit user ------------------------
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,anggota',
            'password' => 'nullable|min:6|confirmed',
            'no_whatsapp' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'status' => 'required|in:aktif,tidak',
            'alasan' => 'nullable|in:sekolah di luar kota,bekerja di luar kota',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $user->identitas()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'no_whatsapp' => $request->no_whatsapp,
                'tanggal_lahir' => $request->tanggal_lahir,
                'status' => $request->status,
                'alasan' => $request->alasan,
            ],
        );

        return redirect()->route('manageUsers.index')->with('success', 'User berhasil diperbarui');
    }

    // ------------------------ Hapus User ------------------------
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('manageUsers.index')->with('success', 'User berhasil dihapus');
    }
    // ------------------------ Tampil User ------------------------
    public function show($id)
    {
        $user = User::with('identitas')->findOrFail($id);

        return view('manageUser.show', compact('user'));
    }
    // ============================ endManage Users ============================
}
