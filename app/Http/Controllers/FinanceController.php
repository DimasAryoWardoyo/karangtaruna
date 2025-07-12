<?php

namespace App\Http\Controllers;

use App\Models\DanaLain;
use App\Models\Hutang;
use App\Models\Kas;
use App\Models\Pengeluaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinanceController extends Controller
{
    public function index()
    {
        // Kas pribadi user
        $kasSaya = Kas::where('user_id', auth()->id())->get();

        // total kas
        $totalKas = Kas::sum('jumlah');

        $saldoDanaLain = DanaLain::sum('jumlah');

        // semua pengeluaran
        $pengeluaran = Pengeluaran::all();

        // total pengeluaran
        $totalPengeluaran = Pengeluaran::sum('jumlah');

        // saldo akhir
        $saldoAkhir = $totalKas + $saldoDanaLain;

        // dana lain
        $danaLainList = DanaLain::orderBy('tanggal', 'desc')->get();

        $hutangs = Hutang::with('user')
            ->where('user_id', auth()->id())
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('finance.index', compact('kasSaya', 'totalKas', 'saldoDanaLain', 'pengeluaran', 'totalPengeluaran', 'saldoAkhir', 'hutangs', 'danaLainList'));
    }

    // ============================== Kas Method ==============================

    public function createKas()
    {
        $users = User::withSum('kas', 'jumlah')->get();
        return view('finance.create_kas', compact('users'));
    }

    public function storeKas(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'users.*' => 'exists:users,id',
        ]);

        $semuaUser = User::all();
        $userYangBayar = collect($request->input('users', []))->map(fn($id) => (int) $id);
        $tanggal = $request->tanggal;
        $jumlah = $request->jumlah;

        foreach ($semuaUser as $user) {
            if ($userYangBayar->contains($user->id)) {
                // Simpan kas
                Kas::create([
                    'user_id' => $user->id,
                    'tanggal' => $tanggal,
                    'jumlah' => $jumlah,
                    'deskripsi' => 'Pembayaran kas pada ' . $tanggal,
                ]);
            } else {
                // Simpan hutang
                Hutang::create([
                    'user_id' => $user->id,
                    'tanggal' => $tanggal,
                    'jumlah' => $jumlah,
                    'keterangan' => 'Belum membayar kas tanggal ' . $tanggal,
                ]);
            }
        }

        return redirect()->route('finance.admin.index')->with('success', 'Kas dan hutang berhasil dicatat.');
    }

    // ============================== Hutang Method ==============================

    public function daftarHutang()
    {
        $hutangs = Hutang::with('user')->orderBy('tanggal', 'desc')->get();
        return view('finance.hutang', compact('hutangs'));
    }

    public function selesaikanHutang($id)
    {
        $hutang = Hutang::findOrFail($id);

        DB::transaction(function () use ($hutang) {
            Kas::create([
                'user_id' => $hutang->user_id,
                'tanggal' => $hutang->tanggal,
                'jumlah' => $hutang->jumlah,
                'deskripsi' => 'Pembayaran hutang: ' . ($hutang->keterangan ?? '-'),
            ]);

            // Hapus hutang
            $hutang->delete();
        });

        return redirect()->route('finance.hutang')->with('success', 'Hutang berhasil dibayarkan.');
    }

    // ============================== Dana Lain Method ==============================

    public function createDanaLain()
    {
        return view('finance.create_dana_lain');
    }

    public function storeDanaLain(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'deskripsi' => 'required|string',
        ]);

        DanaLain::create($request->all());

        return redirect()->route('finance.admin.index')->with('success', 'Dana lain berhasil ditambahkan.');
    }

    // ============================== Pengeluaran Methods ==============================

    public function createPengeluaran()
    {
        return view('finance.create_pengeluaran');
    }

    public function storePengeluaran(Request $request)
    {
        $request->validate([
            'kegiatan' => 'required|string',
            'sumber_dana' => 'required|in:Kas,DanaLain',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string',
            'jumlah' => 'required|numeric|min:1',
            'bukti' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        $buktiPath = $request->file('bukti') ? $request->file('bukti')->store('bukti', 'public') : null;

        Pengeluaran::create([
            'kegiatan' => $request->kegiatan,
            'sumber_dana' => $request->sumber_dana,
            'tanggal' => $request->tanggal,
            'deskripsi' => $request->deskripsi,
            'jumlah' => $request->jumlah,
            'bukti' => $buktiPath,
        ]);

        // Kurangi saldo dari sumber dana yang dipilih
        if ($request->sumber_dana === 'Kas') {
            Kas::create([
                'user_id' => auth()->id(),
                'tanggal' => $request->tanggal,
                'jumlah' => -abs($request->jumlah),
                'deskripsi' => 'Pengeluaran: ' . $request->kegiatan,
            ]);
        } else {
            DanaLain::create([
                'tanggal' => $request->tanggal,
                'jumlah' => -abs($request->jumlah),
                'deskripsi' => 'Pengeluaran: ' . $request->kegiatan,
            ]);
        }

        return redirect()->route('finance.admin.index')->with('success', 'Pengeluaran berhasil ditambahkan.');
    }
}
