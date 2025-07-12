@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading mb-4">
                <h2 class="dashboard-title">Tambah User Baru</h2>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('manageUsers.store') }}" method="POST" autocomplete="off">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-control @error('role') is-invalid @enderror"
                                required>
                                <option value="anggota" {{ old('role') == 'anggota' ? 'selected' : '' }}>Anggota</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>No WhatsApp</label>
                            <input type="text" name="no_whatsapp"
                                class="form-control @error('no_whatsapp') is-invalid @enderror"
                                value="{{ old('no_whatsapp') }}">
                            @error('no_whatsapp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="aktif">Aktif</option>
                                <option value="tidak">Tidak</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Alasan</label>
                            <select name="alasan" class="form-control">
                                <option value="">-</option>
                                <option value="sekolah di luar kota">Sekolah di luar kota</option>
                                <option value="bekerja di luar kota">Bekerja di luar kota</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('manageUsers.index') }}" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
