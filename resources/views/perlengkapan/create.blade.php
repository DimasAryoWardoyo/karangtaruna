@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home">
        <div class="container-fluid">
            <div class="dashboard-heading mb-4">
                <h2>{{ isset($perlengkapan) ? 'Edit' : 'Tambah' }} Perlengkapan</h2>
                <p class="text-muted">Formulir untuk {{ isset($perlengkapan) ? 'mengedit' : 'menambahkan' }} perlengkapan
                </p>
            </div>

            <div class="dashboard-content">
                <div class="row">
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
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" name="nama" id="nama"
                                            value="{{ old('nama', $perlengkapan->nama ?? '') }}"
                                            class="form-control @error('nama') is-invalid @enderror" required>
                                        @error('nama')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <textarea name="deskripsi" id="deskripsi" rows="3" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $perlengkapan->deskripsi ?? '') }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="stok" class="form-label">Stok</label>
                                        <input type="number" name="stok" id="stok"
                                            value="{{ old('stok', $perlengkapan->stok ?? '') }}"
                                            class="form-control @error('stok') is-invalid @enderror" required>
                                        @error('stok')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <a href="{{ auth()->user()->role === 'admin' ? route('perlengkapan.admin.index') : route('perlengkapan.anggota.index') }}"
                                            class="btn btn-danger ms-2">
                                            Kembali
                                        </a>
                                        <button type="submit" class="btn btn-success">
                                            {{ isset($perlengkapan) ? 'Perbarui' : 'Simpan' }}
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
