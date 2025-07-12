@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home">
        <div class="container-fluid">
            <div class="dashboard-heading mb-4">
                <h2>Detail Perlengkapan</h2>
                <p class="text-muted">Informasi lengkap mengenai perlengkapan yang dipilih</p>
            </div>

            <div class="dashboard-content">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body">
                        <table class="table table-bordered mb-4">
                            <tr>
                                <th style="width: 200px">Nama Barang</th>
                                <td>{{ $perlengkapan->nama }}</td>
                            </tr>
                            <tr>
                                <th>Deskripsi</th>
                                <td>{{ $perlengkapan->deskripsi }}</td>
                            </tr>
                            <tr>
                                <th>Stok Tersedia</th>
                                <td>{{ $perlengkapan->stok }}</td>
                            </tr>
                        </table>

                        <div class="d-flex gap-2">
                            <a href="{{ auth()->user()->role === 'admin' ? route('perlengkapan.admin.index') : route('perlengkapan.anggota.index') }}" class="btn btn-danger">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
