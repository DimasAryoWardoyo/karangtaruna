@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading mb-4">
                <h2 class="dashboard-title">Tambah Kas Pribadi</h2>
                <p class="dashboard-subtitle">Untuk pengguna: <strong>{{ $user->name }}</strong></p>
            </div>

            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="card shadow-sm border-0">
                            <div class="card-body">
                                <form action="{{ route('admin.finance.kas.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" name="tanggal" class="form-control" required
                                            value="{{ old('tanggal') }}">
                                        @error('tanggal')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="jumlah">Jumlah (Rp)</label>
                                        <input type="number" name="jumlah" class="form-control" required
                                            value="{{ old('jumlah') }}">
                                        @error('jumlah')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="deskripsi">Deskripsi</label>
                                        <textarea name="deskripsi" class="form-control" rows="3" required>{{ old('deskripsi') }}</textarea>
                                        @error('deskripsi')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    <div class="mt-4 d-flex justify-content-between">
                                        <a href="{{ route('admin.finance.kas.create') }}" class="btn btn-secondary">
                                            Kembali
                                        </a>
                                        <button type="submit" class="btn btn-success">
                                            Simpan Kas
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
