@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading mb-4">
                <h2 class="dashboard-title">Edit Kategori</h2>
                <p class="dashboard-subtitle">
                    Perbarui data kategori yang dipilih
                </p>
            </div>

            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <form method="POST" action="{{ route('content.kategori.update', $kategori->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    {{-- Nama Kategori --}}
                                    <div class="mb-3">
                                        <label>Nama Kategori</label>
                                        <input type="text" name="nama_kategori" class="form-control"
                                            value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
                                    </div>

                                    {{-- Gambar Kategori --}}
                                    <div class="mb-3">
                                        <label>Gambar Kategori Saat Ini</label><br>
                                        @if ($kategori->gambar_kategori)
                                            <img src="{{ asset('storage/' . $kategori->gambar_kategori) }}"
                                                class="img-fluid rounded mb-2" style="max-height: 100px;">
                                        @endif
                                        <input type="file" name="gambar_kategori" class="form-control mt-2">
                                        <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>
                                    </div>

                                    {{-- Tombol --}}
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('content.index') }}" class="btn btn-danger ms-2">Batal</a>
                                        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
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
