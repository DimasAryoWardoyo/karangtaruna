@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">
        <!-- Flash Message -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Heading -->
        <h1 class="h4 mb-2 text-gray-800 font-weight-bold">Edit Konten</h1>
        <p class="mb-4 text-muted">Edit konten yang ada di website Karang Taruna</p>

        <!-- Tombol Aksi -->
        <div class="d-flex flex-wrap justify-content-start mb-3" style="gap: 0.5rem;">
            <a href="{{ route('content.kategori.create') }}" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50"><i class="fas fa-folder-plus"></i></span>
                <span class="text">Tambah Category</span>
            </a>
            <a href="{{ route('konten.create') }}" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                <span class="text">Tambah Konten</span>
            </a>
            <a href="{{ route('content.banneer-create') }}" class="btn btn-warning btn-icon-split text-dark">
                <span class="icon text-white-50"><i class="fas fa-image"></i></span>
                <span class="text">Gambar Banner</span>
            </a>
        </div>

        <!-- Banner Table -->
        <div class="card shadow mb-4 border-0">
            <div class="card-body">
                <h6 class="font-weight-bold mb-3">Daftar Banner</h6>
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($banners as $index => $banner)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td><img src="{{ asset('storage/' . $banner->gambar) }}" class="img-fluid rounded"
                                            style="max-height: 100px;"></td>
                                    <td>
                                        <a href="{{ route('content.banner.edit', $banner->id) }}"
                                            class="btn btn-sm btn-warning text-dark"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('content.banner.destroy', $banner->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Yakin ingin menghapus banner ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">Tidak ada banner.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Kategori Table -->
        <div class="card shadow mb-4 border-0">
            <div class="card-body">
                <h6 class="font-weight-bold mb-3">Daftar Kategori</h6>
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kategoris as $index => $kategori)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $kategori->nama_kategori }}</td>
                                    <td><img src="{{ asset('storage/' . $kategori->gambar_kategori) }}" class="img-fluid"
                                            style="max-height: 70px;"></td>
                                    <td>
                                        <a href="{{ route('content.kategori.edit', $kategori->id) }}"
                                            class="btn btn-sm btn-warning text-dark"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('content.kategori.destroy', $kategori->id) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Tidak ada kategori.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Konten Table -->
        <div class="card shadow mb-4 border-0">
            <div class="card-body">
                <h6 class="font-weight-bold mb-3">Daftar Konten</h6>
                <div class="table-responsive">
                    <table class="table table-bordered text-center align-middle">
                        <thead class="thead-light">
                            <tr>
                                <th>No</th>
                                <th>Nama Konten</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($kontens as $index => $konten)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $konten->nama_konten }}</td>
                                    <td><img src="{{ asset('storage/' . $konten->gambar1) }}" class="img-fluid"
                                            style="max-height: 70px;"></td>
                                    <td>
                                        <a href="{{ route('content.edit', $konten->id) }}"
                                            class="btn btn-sm btn-warning text-dark"><i class="fas fa-edit"></i></a>
                                        <a href="{{ route('content.show', $konten->id) }}"
                                            class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                        <form action="{{ route('content.destroy', $konten->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Yakin ingin menghapus konten ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"><i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">Tidak ada konten.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
