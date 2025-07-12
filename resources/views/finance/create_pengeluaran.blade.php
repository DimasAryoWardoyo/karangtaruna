@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading mb-4">
                <h2 class="dashboard-title">Tambah Pengeluaran</h2>
                <p class="dashboard-subtitle">
                    Silahkan isi data pengeluaran baru
                </p>
            </div>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('finance.pengeluaran.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="sumber_dana">Ambil Dana Dari</label>
                            <select name="sumber_dana" class="form-control" required>
                                <option value="DanaLain">Dana Lain</option>
                                <option value="Kas">Dana Kas</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="kegiatan">Nama Kegiatan</label>
                            <input type="text" name="kegiatan" class="form-control" required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah Pengeluaran</label>
                            <input type="number" name="jumlah" class="form-control" required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group mt-2">
                            <label for="bukti">Upload Bukti (Opsional)</label>
                            <input type="file" name="bukti" class="form-control" accept=".jpg,.jpeg,.png,.pdf">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('finance.admin.index') }}" class="btn btn-danger mt-3">Kembali</a>
                            <button type="submit" class="btn btn-success mt-3">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
