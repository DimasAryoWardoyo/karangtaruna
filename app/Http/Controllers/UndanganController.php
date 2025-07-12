<?php

namespace App\Http\Controllers;

use App\Models\Undangan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class UndanganController extends Controller
{
    public function index()
    {
        $undangans = Undangan::latest()->get();
        return view('undangan.index', compact('undangans'));
    }

    public function create()
    {
        $hubunganOptions = ['orangtua', 'suami', 'istri', 'anak', 'cucu', 'buyut'];
        return view('undangan.create', compact('hubunganOptions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_almarhum' => 'required|string|max:100',
            'umur' => 'nullable|string|max:100',
            'hari_wafat' => 'required|date',
            'jam_wafat' => 'required',
            'lokasi_wafat' => 'required|string|max:255',
            'hari_pemakaman' => 'required|date',
            'jam_pemakaman' => 'required',
            'tempat_pemakaman' => 'required|string|max:255',
            'keluargas.*.nama' => 'required|string|max:100',
            'keluargas.*.hubungan' => 'required|in:orangtua,suami,istri,anak,cucu,buyut',
        ]);

        $undangan = Undangan::create($request->only(['nama_almarhum', 'umur', 'hari_wafat', 'jam_wafat', 'lokasi_wafat', 'hari_pemakaman', 'jam_pemakaman', 'tempat_pemakaman']));

        if ($request->has('keluargas')) {
            foreach ($request->keluargas as $keluarga) {
                $undangan->keluargas()->create($keluarga);
            }
        }

        return redirect()->route('undangan.index')->with('success', 'Undangan berhasil dibuat.');
    }

    public function show($id)
    {
        $undangan = Undangan::with('keluargas')->findOrFail($id);
        return view('undangan.show', compact('undangan'));
    }

    public function edit($id)
    {
        $undangan = Undangan::with('keluargas')->findOrFail($id);
        $hubunganOptions = ['orangtua', 'suami', 'istri', 'anak', 'cucu', 'buyut'];
        return view('undangan.edit', compact('undangan', 'hubunganOptions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_almarhum' => 'required|string|max:100',
            'umur' => 'nullable|string|max:100',
            'hari_wafat' => 'required|date',
            'jam_wafat' => 'required',
            'lokasi_wafat' => 'required|string|max:255',
            'hari_pemakaman' => 'required|date',
            'jam_pemakaman' => 'required',
            'tempat_pemakaman' => 'required|string|max:255',
            'keluargas' => 'required|array|min:1',
            'keluargas.*.nama' => 'required|string|max:100',
            'keluargas.*.hubungan' => 'required|in:orangtua,suami,istri,anak,cucu,buyut',
        ]);

        $undangan = Undangan::findOrFail($id);

        $undangan->update($request->only(['nama_almarhum', 'umur', 'hari_wafat', 'jam_wafat', 'lokasi_wafat', 'hari_pemakaman', 'jam_pemakaman', 'tempat_pemakaman']));

        // Hapus dan simpan ulang data keluarga
        $undangan->keluargas()->delete();

        foreach ($request->keluargas as $kel) {
            $undangan->keluargas()->create($kel);
        }

        return redirect()->route('undangan.index')->with('success', 'Undangan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $undangan = Undangan::findOrFail($id);
        $undangan->delete();
        return redirect()->route('undangan.index')->with('success', 'Undangan berhasil dihapus.');
    }

    public function exportPdf($id)
    {
        $undangan = Undangan::with('keluargas')->findOrFail($id);
        $pdf = Pdf::loadView('undangan.pdf', compact('undangan'));
        return $pdf->download('undangan-' . $undangan->nama_almarhum . '.pdf');
    }
    public function exportWord($id)
    {
        $undangan = Undangan::with('keluargas')->findOrFail($id);

        $content = view('undangan.word', compact('undangan'))->render();

        $fileName = 'undangan-' . $undangan->nama_almarhum . '.doc';

        return response($content)
            ->header('Content-Type', 'application/msword')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }
}
