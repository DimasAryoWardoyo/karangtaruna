@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home">
        <div class="container-fluid">
            <div class="dashboard-heading mb-4">
                <h2 class="mb-1">Daftar Peminjam</h2>
                <p class="text-muted">Berikut adalah daftar peminjaman perlengkapan yang diajukan</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover align-middle">
                                        <thead class="table-secondary text-center">
                                            <tr>
                                                <th>Barang</th>
                                                <th>Jumlah</th>
                                                <th>Peminjam</th>
                                                <th>Tanggal Pinjam</th>
                                                <th>Tanggal Kembali</th>
                                                <th>Status</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($pengajuan as $item)
                                                <tr>
                                                    <td>{{ $item->perlengkapan->nama }}</td>
                                                    <td class="text-center">{{ $item->jumlah }}</td>
                                                    <td>{{ $item->user->name ?? 'Tidak diketahui' }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d M Y') }}
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}
                                                    </td>
                                                    <td class="text-center">
                                                        @php
                                                            $badgeClass = match ($item->status) {
                                                                'berlangsung' => 'bg-warning text-dark',
                                                                'selesai' => 'bg-success',
                                                                'ditolak' => 'bg-danger',
                                                                default => 'bg-secondary',
                                                            };
                                                        @endphp
                                                        <span
                                                            class="badge {{ $badgeClass }}">{{ ucfirst($item->status) }}</span>
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('peminjaman.tanggapi', $item->id) }}"
                                                            method="POST" class="d-flex flex-column gap-1">
                                                            @csrf
                                                            <select name="status" class="form-select form-select-sm">
                                                                <option disabled selected>Pilih Status</option>
                                                                <option value="berlangsung" @selected($item->status === 'berlangsung')>
                                                                    Setujui</option>
                                                                <option value="ditolak" @selected($item->status === 'ditolak')>Tolak
                                                                </option>
                                                                <option value="selesai" @selected($item->status === 'selesai')>Selesai
                                                                </option>
                                                            </select>
                                                            <button type="submit"
                                                                class="btn btn-sm btn-primary">Edit</button>

                                                        </form>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center text-muted">Tidak ada pengajuan
                                                        peminjaman.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-between mt-4">
                                        <a href="{{ route('perlengkapan.admin.index') }}" class="btn btn-danger">Kembali</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
