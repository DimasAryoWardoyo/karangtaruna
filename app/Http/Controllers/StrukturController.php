<?php

namespace App\Http\Controllers;

use App\Models\Struktur;
use App\Models\User;
use Illuminate\Http\Request;

class StrukturController extends Controller
{
    public function index()
    {
        $strukturs = Struktur::with('user')->get();
        return view('struktur.index', compact('strukturs'));
    }

    public function create()
    {
        $users = User::all();
        $struktur = Struktur::all()->keyBy('user_id');
        return view('struktur.create', compact('users', 'struktur'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jabatan' => 'array',
            'jabatan.*' => 'nullable|string|max:255',
        ]);

        $data = $request->input('jabatan');

        foreach ($data as $user_id => $jabatan) {
            $user = User::find($user_id);

            if (!$user) {
                continue;
            }

            if (!empty($jabatan)) {
                Struktur::updateOrCreate(
                    ['user_id' => $user_id],
                    [
                        'nama' => $user->name,
                        'jabatan' => $jabatan,
                    ],
                );
            } else {
                Struktur::where('user_id', $user_id)->delete();
            }
        }

        return redirect()->route('struktur.index')->with('success', 'Struktur organisasi berhasil diperbarui.');
    }

    public function edit(Struktur $struktur) {}
    public function update(Request $request, Struktur $struktur) {}

    public function destroy(Struktur $struktur)
    {
        $struktur->delete();
        return redirect()->route('struktur.index')->with('success', 'Struktur berhasil dihapus.');
    }
}
