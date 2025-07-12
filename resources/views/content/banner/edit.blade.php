@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading mb-4">
                <h2 class="dashboard-title">Edit Gambar Banner</h2>
                <p class="dashboard-subtitle">Perbarui gambar banner halaman utama</p>
            </div>

            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <form method="POST" action="{{ route('content.banner.update', $banner->id) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT') {{-- PENTING --}}

                                    {{-- Gambar Banner Lama --}}
                                    <div class="mb-3">
                                        <label>Gambar Banner Saat Ini</label><br>
                                        <img src="{{ asset('storage/' . $banner->gambar) }}" class="img-fluid rounded mb-2"
                                            style="max-height: 200px;">
                                    </div>

                                    {{-- Gambar Banner Baru --}}
                                    <div class="mb-3">
                                        <label>Ganti Gambar (Opsional)</label>
                                        <input type="file" name="gambar_banner" class="form-control">
                                        <small class="text-muted">Kosongkan jika tidak ingin mengganti gambar</small>
                                    </div>

                                    {{-- Tombol --}}
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ route('content.index') }}" class="btn btn-danger">Batal</a>
                                        <button type="submit" class="btn btn-success">Perbarui</button>
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
