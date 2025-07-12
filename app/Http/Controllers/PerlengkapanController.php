<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Perlengkapan;
use Illuminate\Http\Request;

class PerlengkapanController extends Controller
{
    // ========================= Perlengkapan Method =========================
    public function perlengkapanIndex()
    {
        $perlengkapans = Perlengkapan::all();
        return view('perlengkapan.index', compact('perlengkapans'));
    }

    // Detail barang
    public function perlengkapanShow(Perlengkapan $perlengkapan)
    {
        return view('perlengkapan.show', compact('perlengkapan'));
    }

    // Admin - form tambah barang
    public function perlengkapanCreate()
    {
        return view('perlengkapan.create');
    }

    public function perlengkapanStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'deskripsi' => 'nullable|string',
            'stok' => 'required|integer|min:1',
        ]);

        Perlengkapan::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'stok_awal' => $request->stok, // otomatis isi stok_awal
        ]);

        return redirect()->route('perlengkapan.admin.index')->with('success', 'Perlengkapan berhasil ditambahkan.');
    }

    // Admin - edit barang
    public function perlengkapanEdit(Perlengkapan $perlengkapan)
    {
        return view('perlengkapan.edit', compact('perlengkapan'));
    }

    public function perlengkapanUpdate(Request $request, Perlengkapan $perlengkapan)
    {
        $request->validate([
            'nama' => 'required',
            'stok' => 'required|integer|min:0',
        ]);

        $perlengkapan->update($request->all());

        return redirect()->route('perlengkapan.admin.index')->with('success', 'Barang diperbarui');
    }

    public function perlengkapanDestroy(Perlengkapan $perlengkapan)
    {
        $perlengkapan->delete();
        return redirect()->route('perlengkapan.admin.index')->with('success', 'Barang dihapus');
    }

    // ========================= Peminjaman Method =========================
    public function peminjamanIndex()
    {
        $perlengkapans = Perlengkapan::with([
            'peminjamans' => function ($query) {
                $query->where('status', 'berlangsung');
            },
        ])->get();

        foreach ($perlengkapans as $item) {
            $item->status = $item->peminjamans->count() > 0 ? 'Dipinjam' : 'Tersedia';
        }

        return view('perlengkapan.pinjam.index', compact('perlengkapans'));
    }

    public function peminjamanCreate($id)
    {
        $perlengkapan = Perlengkapan::findOrFail($id);
        return view('perlengkapan.pinjam.create', compact('perlengkapan'));
    }

    public function peminjamanStore(Request $request)
    {
        $request->validate([
            'perlengkapan_id' => 'required|exists:perlengkapans,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $perlengkapan = Perlengkapan::findOrFail($request->perlengkapan_id);

        // Cek logika stok hanya sebagai validasi awal (stok tidak dikurangi dulu)
        if ($perlengkapan->stok < $request->jumlah) {
            return redirect()
                ->back()
                ->withErrors(['jumlah' => 'Jumlah melebihi stok tersedia.']);
        }

        // Simpan pengajuan, status menunggu
        Peminjaman::create([
            'user_id' => auth()->id(),
            'perlengkapan_id' => $request->perlengkapan_id,
            'jumlah' => $request->jumlah,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'menunggu',
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Pengajuan berhasil dikirim, menunggu persetujuan.');
    }

    public function daftarPengajuan()
    {
        $pengajuan = Peminjaman::with(['user', 'perlengkapan'])->get(); // ambil semua
        return view('perlengkapan.pinjam.tanggapan', compact('pengajuan'));
    }
    public function tanggapi(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'status' => 'required|in:berlangsung,ditolak,selesai',
        ]);

        if ($peminjaman->status !== 'menunggu' && $peminjaman->status !== 'berlangsung') {
            return back()->with('error', 'Peminjaman sudah ditanggapi.');
        }

        $perlengkapan = $peminjaman->perlengkapan;

        // Jika berlangsung → kurangi stok
        if ($request->status === 'berlangsung') {
            if ($perlengkapan->stok < $peminjaman->jumlah) {
                return back()->with('error', 'Stok tidak mencukupi.');
            }
            $perlengkapan->stok -= $peminjaman->jumlah;
            $perlengkapan->save();
        }

        // Jika selesai (manual) → kembalikan stok (tapi hanya jika status sebelumnya "berlangsung")
        if ($request->status === 'selesai' && $peminjaman->status === 'berlangsung') {
            $perlengkapan->stok += $peminjaman->jumlah;
            $perlengkapan->save();
        }

        $peminjaman->status = $request->status;
        $peminjaman->save();

        return redirect()->route('peminjaman.tanggapan')->with('success', 'Tanggapan berhasil dikirim.');
    }

    public function cekDanKembalikan()
    {
        $peminjamanSelesai = Peminjaman::where('status', 'berlangsung')->whereDate('tanggal_kembali', '<', now())->get();

        foreach ($peminjamanSelesai as $peminjaman) {
            $perlengkapan = $peminjaman->perlengkapan;
            $perlengkapan->stok += $peminjaman->jumlah;
            $perlengkapan->save();

            $peminjaman->status = 'selesai';
            $peminjaman->save();
        }

        return redirect()->back()->with('success', 'Stok barang dikembalikan untuk peminjaman yang selesai.');
    }
}
