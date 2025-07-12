@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Daftar Hutang</h2>
                <p class="dashboard-subtitle">Data anggota yang belum membayar kas</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                <table class="table table-bordered">
                                    <thead class="table-secondary text-center">
                                        <tr>
                                            <th>Nama</th>
                                            <th>Tanggal</th>
                                            <th>Jumlah</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($hutangs as $hutang)
                                            <tr class="text-center">
                                                <td>{{ $hutang->user->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($hutang->tanggal)->format('d M Y') }}</td>
                                                <td>Rp {{ number_format($hutang->jumlah, 0, ',', '.') }}</td>
                                                <td>{{ $hutang->keterangan }}</td>
                                                <td>
                                                    <form action="{{ route('finance.selesai_hutang', $hutang->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Bayar hutang ini sekarang?')">
                                                        @csrf
                                                        @method('POST')
                                                        <button type="submit" class="btn btn-warning">Membayar</button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <a href="{{ route('finance.admin.index') }}" class="btn btn-secondary mt-3">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
