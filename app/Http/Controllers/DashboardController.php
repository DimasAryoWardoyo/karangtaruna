<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\DanaLain;
use App\Models\Kas;
use App\Models\Pengeluaran;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();

        if ($user->role === 'admin') {
            $totalKas = Kas::sum('jumlah');
            $danaLain = DanaLain::sum('jumlah');
            $totalPengeluaran = Pengeluaran::sum('jumlah');
            $anggota = User::where('role', 'anggota')->count();
            $kasSaya = $totalKas; // agar bisa dipakai di tampilan admin
        } else {
            $totalKas = Kas::sum('jumlah');
            $danaLain = DanaLain::sum('jumlah');
            $totalPengeluaran = Pengeluaran::sum('jumlah');
            $anggota = null;
        }

        // hanya kegiatan yang akan datang atau sedang berlangsung
        $events = Agenda::where('kategori', 'kegiatan')
            ->whereDate('waktu_selesai', '>=', now())
            ->orderBy('waktu_mulai', 'asc')
            ->get()
            ->filter(function ($agenda) {
                return in_array($agenda->status, ['Akan Datang', 'Sedang Berlangsung']);
            });
        return view('dashboard.index', compact('totalPengeluaran', 'anggota', 'danaLain', 'totalKas', 'events'));
    }
}
