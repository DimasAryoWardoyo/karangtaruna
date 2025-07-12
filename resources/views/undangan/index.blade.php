@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h3 class="mb-3">Daftar Undangan Lelayu</h3>
        <a href="{{ route('undangan.create') }}" class="btn btn-primary mb-3">+ Buat Undangan</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($undangans->isEmpty())
            <div class="alert alert-info">Belum ada undangan dibuat.</div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama Almarhum</th>
                        <th>Umur</th>
                        <th>Tanggal Wafat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($undangans as $item)
                        <tr>
                            <td>{{ $item->nama_almarhum }}</td>
                            <td>{{ $item->umur ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->hari)->translatedFormat('d F Y') }}</td>
                            <td>
                                <a href="{{ route('undangan.show', $item->id) }}" class="btn btn-info btn-sm">Lihat</a>
                                <a href="{{ route('undangan.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('undangan.destroy', $item->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus undangan ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
