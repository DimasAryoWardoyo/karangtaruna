@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading mb-4">
                <h2 class="dashboard-title">
                    Tambah Gambar Banner
                </h2>
                <p class="dashboard-subtitle">
                    Masukkan data gambar banner baru
                    <br> untuk menambah gambar banner di halaman utama
                </p>
            </div>

            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <form method="POST" action="{{ route('content.banner.store') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    {{-- Gambar Banner --}}
                                    <div class="mb-3">
                                        <label>Gambar Banner</label>
                                        <input type="file" name="gambar_banner" class="form-control" required>
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
@endsection
