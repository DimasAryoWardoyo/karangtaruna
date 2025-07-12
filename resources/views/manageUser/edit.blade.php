@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading mb-4">
                <h2 class="dashboard-title">Edit User</h2>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('manageUsers.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $user->name) }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $user->email) }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Role</label>
                            <select name="role" class="form-control @error('role') is-invalid @enderror">
                                <option value="anggota" {{ old('role', $user->role) == 'anggota' ? 'selected' : '' }}>
                                    Anggota
                                </option>
                                <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin
                                </option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Password (biarkan kosong jika tidak diubah)</label>
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <hr>

                        <div class="mb-3">
                            <label>No WhatsApp</label>
                            <input type="text" name="no_whatsapp"
                                class="form-control @error('no_whatsapp') is-invalid @enderror"
                                value="{{ old('no_whatsapp', optional($user->identitas)->no_whatsapp) }}">
                            @error('no_whatsapp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir"
                                class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                value="{{ old('tanggal_lahir', optional($user->identitas)->tanggal_lahir) }}">
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="aktif"
                                    {{ old('status', optional($user->identitas)->status) == 'aktif' ? 'selected' : '' }}>
                                    Aktif</option>
                                <option value="tidak"
                                    {{ old('status', optional($user->identitas)->status) == 'tidak' ? 'selected' : '' }}>
                                    Tidak</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Alasan</label>
                            <select name="alasan" class="form-control @error('alasan') is-invalid @enderror">
                                <option value="">-</option>
                                <option value="sekolah di luar kota"
                                    {{ old('alasan', optional($user->identitas)->alasan) == 'sekolah di luar kota' ? 'selected' : '' }}>
                                    Sekolah
                                    di luar kota</option>
                                <option value="bekerja di luar kota"
                                    {{ old('alasan', optional($user->identitas)->alasan) == 'bekerja di luar kota' ? 'selected' : '' }}>
                                    Bekerja
                                    di luar kota</option>
                            </select>
                            @error('alasan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('manageUsers.index') }}" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
