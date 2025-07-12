@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h3 class="mb-4">Buat Undangan Lelayu</h3>

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

        <form action="{{ route('undangan.store') }}" method="POST">
            @csrf

            {{-- Informasi Almarhum --}}
            <div class="card mb-3">
                <div class="card-header">Informasi Almarhum</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label>Nama Almarhum</label>
                        <input type="text" name="nama_almarhum" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Usia</label>
                        <input type="text" name="umur" class="form-control">
                    </div>
                </div>
            </div>

            {{-- Waktu Wafat --}}
            <div class="card mb-3">
                <div class="card-header">Waktu Wafat</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label>Hari & Tanggal</label>
                        <input type="date" name="hari_wafat" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Jam</label>
                        <input type="time" name="jam_wafat" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Lokasi Wafat</label>
                        <input type="text" name="lokasi_wafat" class="form-control" required>
                    </div>
                </div>
            </div>

            {{-- Waktu Pemakaman --}}
            <div class="card mb-3">
                <div class="card-header">Waktu Pemakaman</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label>Hari & Tanggal</label>
                        <input type="date" name="hari_pemakaman" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Jam</label>
                        <input type="time" name="jam_pemakaman" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Tempat Pemakaman</label>
                        <input type="text" name="tempat_pemakaman" class="form-control" required>
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
                    <div class="row keluarga-item mb-2">
                        <div class="col-md-6">
                            <input type="text" name="keluargas[0][nama]" class="form-control" placeholder="Nama"
                                required>
                        </div>
                        <div class="col-md-5">
                            <select name="keluargas[0][hubungan]" class="form-control" required>
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
                </div>
            </div>

            <button class="btn btn-primary">Simpan Undangan</button>
            <a href="{{ route('undangan.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    
    <script>
        let index = 1;

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
