@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                Dashboard {{ Auth::user()->role == 'admin' ? 'Admin' : 'Anggota' }}
            </h1>
            <span class="text-muted">Selamat datang, {{ Auth::user()->name }}</span>
        </div>

        <!-- Content Row -->
        <div class="row">
            {{-- Admin View --}}
            @if (Auth::user()->role == 'admin')
                @php
                    $adminCards = [
                        [
                            'title' => 'Total Kas',
                            'value' => $totalKas,
                            'icon' => 'fas fa-wallet',
                            'color' => 'info',
                        ],
                        [
                            'title' => 'Total Saldo',
                            'value' => $danaLain,
                            'icon' => 'fas fa-coins',
                            'color' => 'primary',
                        ],
                        [
                            'title' => 'Total Pengeluaran',
                            'value' => $totalPengeluaran,
                            'icon' => 'fas fa-money-bill-wave',
                            'color' => 'danger',
                        ],
                        [
                            'title' => 'Jumlah Anggota',
                            'value' => $anggota,
                            'icon' => 'fas fa-users',
                            'color' => 'warning',
                            'isCurrency' => false,
                        ],
                    ];
                @endphp

                @foreach ($adminCards as $card)
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-{{ $card['color'] }} shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-{{ $card['color'] }} text-uppercase mb-1">
                                            {{ $card['title'] }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            {{ isset($card['isCurrency']) && $card['isCurrency'] === false
                                                ? $card['value']
                                                : 'Rp ' . number_format($card['value'], 0, ',', '.') }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="{{ $card['icon'] }} fa-2x text-{{ $card['color'] }}"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- Anggota View --}}
            @else
                @php
                    $anggotaCards = [
                        [
                            'title' => 'Saldo Kas',
                            'value' => $totalKas,
                            'icon' => 'fas fa-wallet',
                            'color' => 'info',
                        ],
                        [
                            'title' => 'Saldo Lain',
                            'value' => $danaLain,
                            'icon' => 'fas fa-coins',
                            'color' => 'primary',
                        ],
                        [
                            'title' => 'Total Pengeluaran',
                            'value' => $totalPengeluaran,
                            'icon' => 'fas fa-money-bill-wave',
                            'color' => 'danger',
                        ],
                    ];
                @endphp

                @foreach ($anggotaCards as $card)
                    <div class="col-xl-4 col-md-6 mb-4">
                        <div class="card border-left-{{ $card['color'] }} shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-{{ $card['color'] }} text-uppercase mb-1">
                                            {{ $card['title'] }}
                                        </div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
                                            Rp {{ number_format($card['value'], 0, ',', '.') }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="{{ $card['icon'] }} fa-2x text-{{ $card['color'] }}"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        <!-- Kegiatan Yang Akan Diselenggarakan -->
        <div class="col-md-12 mt-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-4">Kegiatan Yang Akan Diselenggarakan</h5>

                    @forelse ($events as $event)
                        @if (in_array($event->status, ['Akan Datang', 'Sedang Berlangsung']))
                            <div class="row bg-light mb-2 p-3 rounded shadow-sm align-items-center">
                                <div class="col-md-3 text-truncate w-100">{{ $event->nama_agenda }}</div>
                                <div class="col-md-3 text-truncate w-100">{{ $event->lokasi }}</div>
                                <div class="col-md-3">
                                    {{ \Carbon\Carbon::parse($event->waktu_mulai)->format('d F Y') }}
                                </div>
                                <div class="col-md-2">
                                    <h5>
                                        @if ($event->status === 'Akan Datang')
                                            <span class="badge badge-warning text-dark">Akan Datang</span>
                                        @elseif($event->status === 'Sedang Berlangsung')
                                            <span class="badge badge-success">Sedang Berlangsung</span>
                                        @endif
                                    </h5>
                                </div>
                                <div class="col-md-1">
                                    <a class="text-black p-3"
                                        href="{{ auth()->user()->role === 'admin'
                                            ? route('agenda.admin.show', $event->id)
                                            : route('agenda.anggota.show', $event->id) }}">
                                        <i class="fa fa-chevron-right"></i>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="text-center text-muted">Belum ada kegiatan yang akan datang.</div>
                    @endforelse

                </div>
            </div>
        </div>
    </div>
@endsection
