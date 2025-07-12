@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h3 class="mb-4">Edit Undangan Lelayu</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Periksa input:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('undangan.update', $undangan->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Informasi Almarhum --}}
            <div class="card mb-3">
                <div class="card-header">Informasi Almarhum</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label>Nama Almarhum</label>
                        <input type="text" name="nama_almarhum" class="form-control"
                            value="{{ old('nama_almarhum', $undangan->nama_almarhum) }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Usia</label>
                        <input type="text" name="umur" class="form-control"
                            value="{{ old('umur', $undangan->umur) }}">
                    </div>
                </div>
            </div>

            {{-- Waktu Wafat --}}
            <div class="card mb-3">
                <div class="card-header">Waktu Wafat</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label>Hari & Tanggal</label>
                        <input type="date" name="hari_wafat" class="form-control"
                            value="{{ old('hari_wafat', $undangan->hari_wafat) }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Jam</label>
                        <input type="time" name="jam_wafat" class="form-control"
                            value="{{ old('jam_wafat', $undangan->jam_wafat) }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Lokasi Wafat</label>
                        <input type="text" name="lokasi_wafat" class="form-control"
                            value="{{ old('lokasi_wafat', $undangan->lokasi_wafat) }}" required>
                    </div>
                </div>
            </div>

            {{-- Waktu Pemakaman --}}
            <div class="card mb-3">
                <div class="card-header">Waktu Pemakaman</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label>Hari & Tanggal</label>
                        <input type="date" name="hari_pemakaman" class="form-control"
                            value="{{ old('hari_pemakaman', $undangan->hari_pemakaman) }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Jam</label>
                        <input type="time" name="jam_pemakaman" class="form-control"
                            value="{{ old('jam_pemakaman', $undangan->jam_pemakaman) }}" required>
                    </div>
                    <div class="mb-3">
                        <label>Tempat Pemakaman</label>
                        <input type="text" name="tempat_pemakaman" class="form-control"
                            value="{{ old('tempat_pemakaman', $undangan->tempat_pemakaman) }}" required>
                    </div>
                </div>
            </div>

            {{-- Keluarga yang Ditinggalkan --}}
            <div class="card mb-3">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Keluarga yang Ditinggalkan</span>
                    <button type="button" class="btn btn-sm btn-secondary" onclick="addKeluarga()">+ Tambah</button>
                </div>
                <div class="card-body" id="keluarga-list">
                    @foreach ($undangan->keluargas as $index => $keluarga)
                        <div class="row keluarga-item mb-2">
                            <div class="col-md-6">
                                <input type="text" name="keluargas[{{ $index }}][nama]" class="form-control"
                                    placeholder="Nama" value="{{ $keluarga->nama }}" required>
                            </div>
                            <div class="col-md-5">
                                <select name="keluargas[{{ $index }}][hubungan]" class="form-control" required>
                                    <option value="">-- Pilih Hubungan --</option>
                                    @foreach ($hubunganOptions as $item)
                                        <option value="{{ $item }}"
                                            {{ $keluarga->hubungan == $item ? 'selected' : '' }}>
                                            {{ ucfirst($item) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-1 d-flex align-items-center">
                                <button type="button" class="btn btn-danger btn-sm"
                                    onclick="removeKeluarga(this)">X</button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <button class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('undangan.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script>
        let index = {{ $undangan->keluargas->count() }};

        function addKeluarga() {
            let container = document.getElementById('keluarga-list');
            let html = `
        <div class="row keluarga-item mb-2">
            <div class="col-md-6">
                <input type="text" name="keluargas[${index}][nama]" class="form-control" placeholder="Nama" required>
            </div>
            <div class="col-md-5">
                <select name="keluargas[${index}][hubungan]" class="form-control" required>
                    <option value="">-- Pilih Hubungan --</option>
                    @foreach ($hubunganOptions as $item)
                        <option value="{{ $item }}">{{ ucfirst($item) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1 d-flex align-items-center">
                <button type="button" class="btn btn-danger btn-sm" onclick="removeKeluarga(this)">X</button>
            </div>
        </div>
        `;
            container.insertAdjacentHTML('beforeend', html);
            index++;
        }

        function removeKeluarga(button) {
            button.closest('.keluarga-item').remove();
        }
    </script>
@endsection
