@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">

        {{-- Flash Message (SB Admin 2) --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses!</strong> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <h1 class="h4 mb-2 text-gray-800 font-weight-bold">Daftar Keuangan</h1>
        <p class="mb-4 text-muted">Kelola keuangan Karang Taruna</p>

        @if (Auth::user()->role === 'admin')
            <!-- Tombol Aksi -->
            <div class="d-flex flex-wrap justify-content-end mb-4" style="gap: 0.5rem;">
                <a href="{{ route('finance.kas.create') }}" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50"><i class="fas fa-coins"></i></span>
                    <span class="text">Tambah Kas</span>
                </a>
                <a href="{{ route('finance.hutang') }}" class="btn btn-warning btn-icon-split text-dark">
                    <span class="icon text-white-50"><i class="fas fa-file-invoice-dollar"></i></span>
                    <span class="text">Lihat Hutang</span>
                </a>
                <a href="{{ route('finance.dana-lain.create') }}" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50"><i class="fas fa-donate"></i></span>
                    <span class="text">Tambah Dana Lain</span>
                </a>
                <a href="{{ route('finance.pengeluaran.create') }}" class="btn btn-danger btn-icon-split">
                    <span class="icon text-white-50"><i class="fas fa-money-bill-wave"></i></span>
                    <span class="text">Tambah Pengeluaran</span>
                </a>
            </div>
        @endif


        <!-- Ringkasan Keuangan -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered text-center mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Total Kas</th>
                                <th>Total Dana Lain</th>
                                <th>Saldo Saat Ini</th>
                                <th>Total Pengeluaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Rp {{ number_format($totalKas, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($saldoDanaLain, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</td>
                                <td>Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Daftar Hutang -->
        <h5 class="font-weight-bold text-gray-800">Daftar Hutang</h5>
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered text-center mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Nama</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($hutangs as $hutang)
                                <tr>
                                    <td>{{ $hutang->user->name }}</td>
                                    <td>{{ $hutang->tanggal }}</td>
                                    <td>Rp {{ number_format($hutang->jumlah, 0, ',', '.') }}</td>
                                    <td>{{ $hutang->keterangan }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-muted">Tidak ada hutang tercatat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kas Saya -->
        <h5 class="font-weight-bold text-gray-800">Kas Saya</h5>
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered text-center mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kasSaya as $kas)
                                <tr>
                                    <td>{{ $kas->tanggal }}</td>
                                    <td>Rp {{ number_format($kas->jumlah, 0, ',', '.') }}</td>
                                    <td>{{ $kas->deskripsi }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-muted">Belum ada pembayaran kas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Dana Lain -->
        <h5 class="font-weight-bold text-gray-800">Dana Lain</h5>
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered text-center mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($danaLainList as $dana)
                                <tr>
                                    <td>{{ $dana->tanggal }}</td>
                                    <td>Rp {{ number_format($dana->jumlah, 0, ',', '.') }}</td>
                                    <td>{{ $dana->deskripsi }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-muted">Belum ada dana lain tercatat.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Pengeluaran -->
        <h5 class="font-weight-bold text-gray-800">Semua Pengeluaran</h5>
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered text-center mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th>Kegiatan</th>
                                <th>Tanggal</th>
                                <th>Jumlah</th>
                                <th>Bukti</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pengeluaran as $item)
                                <tr>
                                    <td>{{ $item->kegiatan }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                    <td>
                                        @if ($item->bukti)
                                            <img src="{{ asset('storage/' . $item->bukti) }}" alt="Bukti"
                                                style="width: 80px; border-radius: 5px;">
                                        @else
                                            <span class="text-muted">Tidak ada bukti</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Belum ada data pengeluaran.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
