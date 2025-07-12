@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h4>Tambah Dana Lain</h4>
        <form action="{{ route('finance.dana_lain.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" class="form-control" required>
            </div>
            <div class="form-group mt-2">
                <label for="jumlah">Jumlah (Rp)</label>
                <input type="number" name="jumlah" class="form-control" required>
            </div>
            <div class="form-group mt-2">
                <label for="deskripsi">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
            <a href="{{ route('finance.admin.index') }}" class="btn btn-secondary mt-3">Kembali</a>
        </form>
    </div>
@endsection
