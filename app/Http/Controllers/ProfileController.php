<?php

namespace App\Http\Controllers;

use App\Models\Identitas;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function create()
    {
        $users = User::doesntHave('identitas')->get();
        return view('profile.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|unique:identitas,user_id',
            'no_whatsapp' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'status' => 'required|in:aktif,tidak',
            'alasan' => 'nullable|in:sekolah di luar kota,bekerja di luar kota',
        ]);

        Identitas::create($request->all());

        $redirectRoute = auth()->user()->role === 'admin' ? 'profile.index' : 'anggota.profile.index';

        return redirect()->route($redirectRoute)->with('success', 'Identitas berhasil ditambahkan');
    }

    public function edit(Identitas $identitas)
    {
        return view('profile.edit', compact('identitas'));
    }

    public function update(Request $request, Identitas $identitas)
    {
        $request->validate([
            'no_whatsapp' => 'required|string|max:20',
            'tanggal_lahir' => 'required|date',
            'status' => 'required|in:aktif,tidak',
            'alasan' => 'nullable|in:sekolah di luar kota,bekerja di luar kota',
        ]);

        $identitas->update($request->all());

        $redirectRoute = auth()->user()->role === 'admin' ? 'profile.index' : 'anggota.profile.index';

        return redirect()->route($redirectRoute)->with('success', 'Identitas berhasil diperbarui');
    }

    public function destroy(Identitas $identitas)
    {
        if (auth()->user()->id !== $identitas->user_id) {
            abort(403);
        }

        $identitas->delete();
        return redirect()->route('profile.index')->with('success', 'Identitas berhasil dihapus');
    }
}
