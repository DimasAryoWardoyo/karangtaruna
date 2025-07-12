@extends('layouts.dashboard')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Agenda</h1>
        <p class="mb-4">
            Halaman ini menampilkan daftar agenda yang akan datang dan telah berlalu. Anda dapat mengelola
            agenda,
            menambahkan agenda baru, atau mengedit agenda yang sudah ada.
        </p>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold">Daftar Agenda</h6>
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('agenda.admin.create') }}" class="btn btn-sm btn-warning rounded text-dark">
                        <i class="fas fa-plus mr-1"></i> Tambah Agenda
                    </a>
                @endif
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Judul Agenda</th>
                                <th>Lokasi</th>
                                <th>Kategori</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($agenda as $item)
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($item->waktu_mulai)->format('Y-m-d') }}</td>
                                    <td>{{ $item->nama_agenda }}</td>
                                    <td>{{ $item->lokasi }}</td>
                                    <td>{{ ucfirst($item->kategori) }}</td>
                                    <td class="text-center">
                                        <a href="{{ auth()->user()->role === 'admin' ? route('agenda.admin.show', $item->id) : route('agenda.anggota.show', $item->id) }}"
                                            class="btn btn-sm btn-info" title="Lihat Detail">
                                            <i class="fas fa-info-circle"></i>
                                        </a>
                                        <form action="{{ route('agenda.destroy', $item->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Yakin ingin menghapus agenda ini?')">
                                            @csrf
                                            @method('DELETE')
                                            @if (auth()->user()->role === 'admin')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Belum ada agenda.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
@endsection
