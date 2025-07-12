@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2>Ajukan Peminjam</h2>
                <p>Silahkan isi form berikut untuk mengajukan peminjaman perlengkapan.</p>
            </div>
            <div class="dashboard-content">
                <div class="card mb-2 mt-4">
                    <div class="card-body">
                        <div class="container">
                            <form action="{{ route('peminjaman.store') }}" method="POST">
                                @csrf

                                <!-- Hidden input perlengkapan_id -->
                                <input type="hidden" name="perlengkapan_id" value="{{ $perlengkapan->id }}">

                                <div class="mb-3">
                                    <label>Nama Barang</label>
                                    <input type="text" class="form-control" value="{{ $perlengkapan->nama }}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label>Jumlah Tersedia</label>
                                    <input type="number" class="form-control" value="{{ $perlengkapan->stok }}" disabled>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah">Jumlah Pinjam</label>
                                    <input type="number" name="jumlah" class="form-control" min="1"
                                        max="{{ $perlengkapan->stok }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_pinjam">Tanggal Pinjam</label>
                                    <input type="date" name="tanggal_pinjam" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_kembali">Tanggal Kembali</label>
                                    <input type="date" name="tanggal_kembali" class="form-control" required>
                                </div>
                                <div class="d-flex justify-content-between mt-4">
                                    <a href="{{ url()->previous() }}" class="btn btn-danger">Kembali</a>
                                    <button type="submit" class="btn btn-success">Ajukan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
