@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2>Daftar Perlengkapan</h2>
                <p>Berikut adalah daftar perlengkapan yang tersedia</p>
            </div>
            <div class="dashboard-content">
                <div class="card mt-4 mb-2">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Stok</th>
                                    <th>Deskripsi</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($perlengkapans as $item)
                                    <tr>
                                        <td>{{ $item->nama }}</td>
                                        <td>{{ $item->stok }}</td>
                                        <td>{{ $item->deskripsi }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>
                                            <a href="{{ route('peminjaman.create', $item->id) }}"
                                                class="btn btn-info">pilih</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('perlengkapan.anggota.index') }}" class="btn btn-danger">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
