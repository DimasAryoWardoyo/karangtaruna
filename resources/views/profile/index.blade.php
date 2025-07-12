@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Profile</h2>
                <p class="dashboard-subtitle">Kelola Identitas Anda Dengan Benar!</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    {{-- AKUN --}}
                    <div class="col-md-6">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-subtitle mb-2">
                                    Akun
                                    <a href="{{ auth()->user()->role === 'admin' ? route('profile.edit-profile') : route('anggota.profile.edit-profile') }}"
                                        class="btn btn-sm btn-warning float-end">
                                        Edit <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Nama</th>
                                            <td>{{ Auth::user()->name }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ Auth::user()->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Role</th>
                                            <td>{{ Auth::user()->role }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- IDENTITAS --}}
                    <div class="col-md-6">
                        <div class="card mb-2">
                            <div class="card-body">
                                <div class="dashboard-card-subtitle mb-2">
                                    Identitas
                                    @if (Auth::user()->identitas)
                                        <a href="{{ auth()->user()->role === 'admin'
                                            ? route('profile.edit', Auth::user()->identitas->id)
                                            : route('profile.anggota.edit', Auth::user()->identitas->id) }}"
                                            class="btn btn-sm btn-warning float-end me-2">
                                            Edit <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                        </a>
                                    @else
                                        <a href="{{ auth()->user()->role === 'admin' ? route('profile.create-admin') : route('profile.anggota.create') }}"
                                            class="btn btn-primary float-end me-2">
                                            Isi Identitas
                                        </a>
                                    @endif
                                </div>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Nomor HP</th>
                                            <td>{{ Auth::user()->identitas->no_whatsapp ?? 'Belum diisi' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Lahir</th>
                                            <td>{{ Auth::user()->identitas->tanggal_lahir ?? 'Belum diisi' }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                {{ Auth::user()->identitas->status ?? 'Belum diisi' }}

                                                @if (Auth::user()->identitas && Auth::user()->identitas->status == 'tidak')
                                                    <div class="mt-2">
                                                        <strong>Alasan:</strong>
                                                        {{ Auth::user()->identitas->alasan ?? 'Tidak ada alasan' }}
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
