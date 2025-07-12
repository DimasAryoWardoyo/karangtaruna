@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading mb-4">
                <h2 class="dashboard-title">Struktur Organisasi Karang Taruna</h2>
                <p class="dashboard-subtitle">
                    Berikut adalah struktur organisasi Karang Taruna yang ada di desa kami.
                </p>
            </div>

            <div class="dashboard-content">
                <div class="d-flex justify-content-between mb-4">
                    <h5>Struktur Organisasi</h5>
                    @if (Auth::user()->role === 'admin')
                        <a href="{{ route('struktur.create') }}" class="btn text-dark btn-warning">Konfigurasi Struktur</a>
                    @endif
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
                                <h5 class="card-title text-dark fw-bold">Ketua</h5>
                                <p class="card-text text-dark">{{ $ketua->user->name ?? '-' }}</p>
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
                                <h5 class="card-title text-dark fw-bold">Wakil Ketua</h5>
                                <p class="card-text text-dark">{{ $wakil->user->name ?? '-' }}</p>
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
                                    <h5 class="card-title text-dark fw-bold">{{ $sekretaris->jabatan }}</h5>
                                    <p class="card-text text-dark">{{ $sekretaris->user->name ?? '-' }}</p>
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
                                    <h5 class="card-title text-dark fw-bold">{{ $bendahara->jabatan }}</h5>
                                    <p class="card-text text-dark">{{ $bendahara->user->name ?? '-' }}</p>
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
                                    <h5 class="card-title text-dark fw-bold">{{ $pengurus->jabatan }}</h5>
                                    <p class="card-text text-dark">{{ $pengurus->user->name ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
