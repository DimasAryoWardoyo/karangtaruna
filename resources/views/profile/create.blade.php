@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading mb-4">
                <h2 class="dashboard-title">Tambah Identitas Baru</h2>
                <p class="dashboard-subtitle">Silahkan isi data identitas baru</p>
            </div>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form
                        action="{{ auth()->user()->role === 'admin' ? route('profile.store-admin') : route('profile.anggota.store') }}"
                        method="POST">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label>No WhatsApp</label>
                                <input type="text" name="no_whatsapp" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="aktif">Aktif</option>
                                    <option value="tidak">Tidak</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Alasan</label>
                                <select name="alasan" class="form-control">
                                    <option value="">-</option>
                                    <option value="sekolah di luar kota">Sekolah di luar kota</option>
                                    <option value="bekerja di luar kota">Bekerja di luar kota</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ auth()->user()->role === 'admin' 
                                        ? route('profile.index') 
                                        : route('anggota.profile.index') }}" 
                               class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
