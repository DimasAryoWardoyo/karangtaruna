@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home">
        <div class="container-fluid">
            <div class="dashboard-heading mb-4">
                <h2 class="mb-1">{{ isset($perlengkapan) ? 'Edit' : 'Tambah' }} Perlengkapan</h2>
                <p class="text-muted">Silakan lengkapi data berikut dengan benar</p>
            </div>
            <div class="dashboard-content">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <form method="POST"
                                    action="{{ isset($perlengkapan) ? route('perlengkapan.update', $perlengkapan->id) : route('perlengkapan.store') }}">
                                    @csrf
                                    @if (isset($perlengkapan))
                                        @method('PUT')
                                    @endif

                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama Perlengkapan</label>
                                        <input type="text" name="nama" id="nama"
                                            value="{{ old('nama', $perlengkapan->nama ?? '') }}"
                                            class="form-control @error('nama') is-invalid @enderror" required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $perlengkapan->deskripsi ?? '') }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="stok" class="form-label">Jumlah Stok</label>
                                        <input type="number" name="stok" id="stok"
                                            value="{{ old('stok', $perlengkapan->stok ?? '') }}"
                                            class="form-control @error('stok') is-invalid @enderror" required>
                                        @error('stok')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('perlengkapan.admin.index') }}" class="btn btn-danger">Kembali</a>
                                        <button type="submit" class="btn btn-success">
                                            {{ isset($perlengkapan) ? 'Update' : 'Simpan' }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
