@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Tambah Kas Pribadi</h2>
                <p class="dashboard-subtitle">Sesuaikan dengan kebutuhan anda</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif

                                <form action="{{ route('finance.kas.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label">Tanggal</label>
                                        <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                                    </div>

                                    <table class="table table-bordered table-hover">
                                        <thead class="table-secondary text-center">
                                            <tr>
                                                <th>Nama</th>
                                                <th>Total Kas Masuk</th>
                                                <th>
                                                    Pilih Pembayar <br>
                                                    <input type="checkbox" id="checkAll">
                                                    <label for="checkAll">Sellect All</label>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr class="text-center">
                                                    <td>{{ $user->name }}</td>
                                                    <td>Rp {{ number_format($user->kas_sum_jumlah ?? 0, 0, ',', '.') }}</td>
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input user-checkbox" type="checkbox"
                                                                name="users[]" value="{{ $user->id }}"
                                                                id="userCheck{{ $user->id }}">
                                                            <label class="form-check-label"
                                                                for="userCheck{{ $user->id }}">
                                                                Bayar
                                                            </label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="mb-3">
                                        <label for="jumlah" class="form-label">Nominal Kas per Orang</label>
                                        <input type="number" name="jumlah" id="jumlah" class="form-control"
                                            value="5000" required>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Simpan Kas</button>
                                    <a href="{{ route('finance.admin.index') }}" class="btn btn-secondary">Kembali</a>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tambahkan Script Select All --}}

    <script>
        document.getElementById('checkAll').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.user-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    </script>
@endsection
