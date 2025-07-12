@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading mb-4">
                <h2 class="dashboard-title">Tambah Konten</h2>
                <p class="dashboard-subtitle">Masukkan data konten baru</p>
            </div>

            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <form method="POST" action="{{ route('content.store') }}" enctype="multipart/form-data">
                                    @csrf

                                    {{-- Pilih Kategori --}}
                                    <div class="mb-3">
                                        <label>Kategori</label>
                                        <select name="kategori_id" class="form-control" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach ($kategoris as $kategori)
                                                <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- Nama Konten --}}
                                    <div class="mb-3">
                                        <label>Nama Konten</label>
                                        <input type="text" name="nama_konten" class="form-control" required>
                                    </div>

                                    {{-- Tanggal Konten --}}
                                    <div class="mb-3">
                                        <label>Tanggal Konten</label>
                                        <input type="date" name="tanggal_konten" class="form-control" required>
                                    </div>

                                    {{-- Deskripsi Konten --}}
                                    <div class="mb-3">
                                        <label>Deskripsi</label>
                                        <textarea name="deskripsi" id="editor" class="form-control" rows="6">{{ old('deskripsi') }}</textarea>
                                    </div>

                                    {{-- Gambar Konten --}}
                                    <div class="mb-3">
                                        <label>Gambar 1</label>
                                        <input type="file" name="gambar1" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Gambar 2</label>
                                        <input type="file" name="gambar2" class="form-control" required>
                                    </div>

                                    <div class="mb-3">
                                        <label>Gambar 3</label>
                                        <input type="file" name="gambar3" class="form-control" required>
                                    </div>

                                    {{-- Tombol Simpan --}}
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('content.index') }}" class="btn btn-danger ms-2">Batal</a>
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CKEditor CDN --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
