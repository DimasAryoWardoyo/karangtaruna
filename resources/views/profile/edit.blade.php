@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading mb-4">
                <h2 class="dashboard-title">Edit Identitas</h2>
                <p class="dashboard-subtitle">Silahkan perbarui data identitas</p>
            </div>

            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form
                        action="{{ auth()->user()->role === 'admin' ? route('profile.update', $identitas->id) : route('profile.anggota-update', $identitas->id) }}"
                        method="POST" onsubmit="return confirm('Yakin ingin memperbarui data identitas ini?')">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            {{-- No WhatsApp --}}
                            <div class="col-md-6 mb-3">
                                <label>No WhatsApp</label>
                                <input type="text" name="no_whatsapp" class="form-control"
                                    value="{{ old('no_whatsapp', $identitas->no_whatsapp) }}">
                            </div>

                            {{-- Tanggal Lahir --}}
                            <div class="col-md-6 mb-3">
                                <label>Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control"
                                    value="{{ old('tanggal_lahir', $identitas->tanggal_lahir) }}">
                            </div>

                            {{-- Status --}}
                            <div class="col-md-6 mb-3">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="aktif" {{ $identitas->status == 'aktif' ? 'selected' : '' }}>Aktif
                                    </option>
                                    <option value="tidak" {{ $identitas->status == 'tidak' ? 'selected' : '' }}>Tidak
                                    </option>
                                </select>
                            </div>

                            {{-- Alasan --}}
                            <div class="col-md-6 mb-3">
                                <label>Alasan</label>
                                <select name="alasan" class="form-control">
                                    <option value="">-</option>
                                    <option value="sekolah di luar kota"
                                        {{ $identitas->alasan == 'sekolah di luar kota' ? 'selected' : '' }}>
                                        Sekolah di luar kota
                                    </option>
                                    <option value="bekerja di luar kota"
                                        {{ $identitas->alasan == 'bekerja di luar kota' ? 'selected' : '' }}>
                                        Bekerja di luar kota
                                    </option>
                                </select>
                            </div>
                        </div>

                        {{-- Tombol --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ auth()->user()->role === 'admin' ? route('profile.index') : route('anggota.profile.index') }}"
                                class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-success">Perbarui</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
