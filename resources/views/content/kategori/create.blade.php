@extends('layouts.dashboard')

@section('content')
    @extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <div class="dashboard-heading mb-4">
            <h2 class="dashboard-title">Tambah Kategori</h2>
            <p class="dashboard-subtitle">Masukkan data kategori baru</p>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form method="POST" action="{{ route('content.kategori.store') }}" enctype="multipart/form-data">
                    @csrf

                    {{-- Nama Kategori --}}
                    <div class="mb-3">
                        <label>Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control" required>
                    </div>

                    {{-- Gambar Kategori --}}
                    <div class="mb-3">
                        <label>Gambar Kategori</label>
                        <input type="file" name="gambar_kategori" class="form-control" required>
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('content.index') }}" class="btn btn-danger">Batal</a>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@endsection
