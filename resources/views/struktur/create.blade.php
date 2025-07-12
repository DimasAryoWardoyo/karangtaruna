@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading mb-4">
                <h2 class="dashboard-title">
                    Konfigurasi Struktur Organisasi
                </h2>
                <p class="dashboard-subtitle">
                    Konfigurasi struktur organisasi yang sesuai dengan kebutuhan perusahaan Anda
                </p>
            </div>
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <form action="{{ route('struktur.store') }}" method="POST">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nama User</th>
                                        <th>Jabatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        @php
                                            $jabatanUser = $struktur[$user->id]->jabatan ?? '';
                                        @endphp
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>
                                                <select name="jabatan[{{ $user->id }}]" class="form-control">
                                                    <option value="" {{ empty($jabatanUser) ? 'selected' : '' }}>--
                                                        Tidak
                                                        Ditugaskan --
                                                    </option>
                                                    <option value="Ketua" {{ $jabatanUser == 'Ketua' ? 'selected' : '' }}>
                                                        Ketua</option>
                                                    <option value="Wakil Ketua"
                                                        {{ $jabatanUser == 'Wakil Ketua' ? 'selected' : '' }}>Wakil
                                                        Ketua</option>
                                                    <option value="Sekretaris I"
                                                        {{ $jabatanUser == 'Sekretaris I' ? 'selected' : '' }}>
                                                        Sekretaris I</option>
                                                    <option value="Sekretaris II"
                                                        {{ $jabatanUser == 'Sekretaris II' ? 'selected' : '' }}>
                                                        Sekretaris II</option>
                                                    <option value="Bendahara I"
                                                        {{ $jabatanUser == 'Bendahara I' ? 'selected' : '' }}>
                                                        Bendahara I</option>
                                                    <option value="Bendahara II"
                                                        {{ $jabatanUser == 'Bendahara II' ? 'selected' : '' }}>
                                                        Bendahara II</option>
                                                    <option value="Pengurus I"
                                                        {{ $jabatanUser == 'Pengurus I' ? 'selected' : '' }}>Pengurus I
                                                    </option>
                                                    <option value="Pengurus II"
                                                        {{ $jabatanUser == 'Pengurus II' ? 'selected' : '' }}>Pengurus
                                                        II</option>
                                                    <option value="Pengurus III"
                                                        {{ $jabatanUser == 'Pengurus III' ? 'selected' : '' }}>
                                                        Pengurus III</option>
                                                    <option value="Pengurus IV"
                                                        {{ $jabatanUser == 'Pengurus IV' ? 'selected' : '' }}>Pengurus
                                                        IV</option>
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{-- Tombol --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('struktur.index') }}" class="btn btn-danger">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
