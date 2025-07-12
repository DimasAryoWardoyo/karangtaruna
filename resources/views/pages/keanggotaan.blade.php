@extends('layouts.app')
@section('title', 'Struktur Organisasi - Karang Taruna Klaten Asyik')

@section('content')
    <div class="page-content page-home" data-aos="fade-up">
        <div class="container py-2">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Struktur Organisasi Karang Taruna</h2>
                <p class="text-muted">
                    berikut adalah struktur organisasi karang taruna yang ada di desa kami
                    <br> untuk lebih jelasnya silahkan hubungi ketua karang taruna
                </p>
            </div>

            @php
                $struktur = $strukturs ?? collect();
                $get = fn($jabatan) => $struktur->where('jabatan', $jabatan)->first();
                $getAll = fn($jabatan) => $struktur->where('jabatan', $jabatan);
            @endphp

            <!-- Ketua -->
            @if ($ketua = $get('Ketua'))
                <div class="text-center">
                    <div class="card border mx-auto" style="width: 250px;">
                        <div class="card-body bg-warning rounded">
                            <h5 class="card-title fw-bold">Ketua</h5>
                            <p class="card-text">{{ $ketua->user->name ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <div class="d-flex justify-content-center">
                <div class="border-start bg-dark" style="height: 40px; width: 3px;"></div>
            </div>

            <!-- Wakil Ketua -->
            @if ($wakil = $get('Wakil Ketua'))
                <div class="text-center">
                    <div class="card border mx-auto" style="width: 250px;">
                        <div class="card-body bg-info rounded">
                            <h5 class="card-title fw-bold">Wakil Ketua</h5>
                            <p class="card-text">{{ $wakil->user->name ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Sekretaris -->
            <div class="d-flex justify-content-center">
                <div class="border-start bg-dark" style="height: 40px; width: 3px;"></div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="border border-dark bg-dark" style="width: 30%; height: 2px;"></div>
            </div>
            <div class="row justify-content-center mt-2">
                @foreach ($struktur->filter(fn($item) => str_starts_with($item->jabatan, 'Sekretaris')) as $sekretaris)
                    <div class="col-md-4 col-12 d-flex justify-content-center">
                        <div class="card border" style="width: 250px;">
                            <div class="card-body bg-success rounded text-center">
                                <h5 class="card-title fw-bold">{{ $sekretaris->jabatan }}</h5>
                                <p class="card-text">{{ $sekretaris->user->name ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Bendahara -->
            <div class="d-flex justify-content-center">
                <div class="border-start bg-dark" style="height: 40px; width: 3px;"></div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="border border-dark bg-dark" style="width: 30%; height: 2px;"></div>
            </div>
            <div class="row justify-content-center mt-2">
                @foreach ($struktur->filter(fn($item) => str_starts_with($item->jabatan, 'Bendahara')) as $bendahara)
                    <div class="col-md-4 col-12 d-flex justify-content-center">
                        <div class="card border" style="width: 250px;">
                            <div class="card-body bg-primary rounded text-center">
                                <h5 class="card-title fw-bold">{{ $bendahara->jabatan }}</h5>
                                <p class="card-text">{{ $bendahara->user->name ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pengurus -->
            <div class="d-flex justify-content-center">
                <div class="border-start bg-dark" style="height: 40px; width: 3px;"></div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="border border-dark bg-dark" style="width: 80%; height: 2px;"></div>
            </div>
            <div class="row justify-content-center mt-2 mb-4">
                @foreach ($struktur->filter(fn($item) => str_starts_with($item->jabatan, 'Pengurus')) as $pengurus)
                    <div class="col-md-3 col-12 d-flex justify-content-center">
                        <div class="card border" style="width: 250px;">
                            <div class="card-body bg-danger rounded text-center">
                                <h5 class="card-title fw-bold">{{ $pengurus->jabatan }}</h5>
                                <p class="card-text">{{ $pengurus->user->name ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-center">
                <div class="border-start bg-dark" style="height: 40px; width: 3px;"></div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="border border-dark bg-dark" style="width: 80%; height: 2px;"></div>
            </div>

            <div class="row justify-content-center">
                <div class="col-10 mt-2">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered text-center align-middle table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Nama</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Status</th>
                                            <th>Alasan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($user as $users)
                                            <tr>
                                                <td>{{ $users->name }}</td>
                                                <td>{{ $users->identitas->tanggal_lahir ?? '-' }}</td>
                                                <td>{{ $users->identitas->status ?? '-' }}</td>
                                                <td>{{ $users->identitas->alasan ?? '-' }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center text-muted">Tidak ada data
                                                    ditampilkan.</td>
                                            </tr>
                                        @endforelse
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
