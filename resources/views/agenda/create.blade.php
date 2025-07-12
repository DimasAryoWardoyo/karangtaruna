@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Buat Agenda Baru</h2>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Oops!</strong> Ada kesalahan dalam input Anda.<br><br>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <form action="{{ route('agenda.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="nama_agenda" class="form-label">Nama Agenda</label>
                                        <input type="text" id="nama_agenda" name="nama_agenda"
                                            class="form-control @error('nama_agenda') is-invalid @enderror"
                                            value="{{ old('nama_agenda') }}" required>
                                        @error('nama_agenda')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <textarea name="deskripsi" id="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror"
                                            required>{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="waktu_mulai" class="form-label">Waktu Mulai</label>
                                            <input type="datetime-local" id="waktu_mulai" name="waktu_mulai"
                                                class="form-control @error('waktu_mulai') is-invalid @enderror"
                                                value="{{ old('waktu_mulai') }}" required>
                                            @error('waktu_mulai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label for="waktu_selesai" class="form-label">Waktu Selesai</label>
                                            <input type="datetime-local" id="waktu_selesai" name="waktu_selesai"
                                                class="form-control @error('waktu_selesai') is-invalid @enderror"
                                                value="{{ old('waktu_selesai') }}" required>
                                            @error('waktu_selesai')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="lokasi" class="form-label">Lokasi</label>
                                        <input type="text" id="lokasi" name="lokasi"
                                            class="form-control @error('lokasi') is-invalid @enderror"
                                            value="{{ old('lokasi') }}" required>
                                        @error('lokasi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <!-- Input Kategori -->
                                    <div class="mb-3">
                                        <label for="kategori" class="form-label">Kategori</label>
                                        <select name="kategori" id="kategori" class="form-control" required
                                            onchange="toggleFotoInput()">
                                            <option value="">-- Pilih Kategori --</option>
                                            <option value="kegiatan"
                                                {{ old('kategori') === 'kegiatan' ? 'selected' : '' }}>
                                                Kegiatan</option>
                                            <option value="rapat" {{ old('kategori') === 'rapat' ? 'selected' : '' }}>
                                                Rapat
                                            </option>
                                        </select>
                                    </div>

                                    <!-- Input Foto (default: hidden) -->
                                    <div class="mb-3" id="foto-container" style="display: none;">
                                        <label for="foto" class="form-label">Foto Kegiatan</label>
                                        <input type="file" name="foto" id="foto" class="form-control"
                                            accept="image/*">
                                    </div>

                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('agenda.admin.index') }}" class="btn btn-danger">Kembali</a>
                                        <button type="submit" class="btn btn-success">Simpan Agenda</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function toggleFotoInput() {
            const kategori = document.getElementById('kategori').value;
            const fotoContainer = document.getElementById('foto-container');

            if (kategori === 'kegiatan') {
                fotoContainer.style.display = 'block';
            } else {
                fotoContainer.style.display = 'none';
            }
        }

        // Saat halaman pertama kali dimuat, pastikan sesuai nilai select
        document.addEventListener("DOMContentLoaded", function() {
            toggleFotoInput();
        });
    </script>

@endsection
