@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading mb-4">
                <h2 class="dashboard-title">Broadcast WhatsApp</h2>
                <p class="dashboard-subtitle">
                    Kirim pesan ke anggota Karang Taruna melalui WhatsApp.
                    <br> Pilih anggota yang ingin dihubungi dan
                    masukkan pesan yang akan dikirim.
                </p>
            </div>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <form action="{{ route('broadcast.send') }}" method="POST" autocomplete="off">
                        @csrf

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered text-center">
                                <thead>
                                    <tr class="text-center">
                                        <th>Nama Anggota</th>
                                        <th>Status</th>
                                        <th>Nomor WhatsApp</th>
                                        <th>Pilih Semua
                                            <input type="checkbox" id="checkAll">
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($anggota as $item)
                                        <tr class="text-center">
                                            <td>{{ $item->user->name ?? '-' }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ $item->no_whatsapp }}</td>
                                            <td>
                                                <input type="checkbox" name="selected_numbers[]"
                                                    value="{{ $item->no_whatsapp }}" class="check-item">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Pesan</label>
                            <textarea name="message" id="message" rows="5" class="form-control @error('message') is-invalid @enderror"
                                placeholder="Tulis isi pesan...">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success">
                            <i class="fa fa-paper-plane me-1"></i> Kirim Pesan
                        </button>
                    </form>

                    <script>
                        document.getElementById('checkAll').addEventListener('change', function() {
                            const checked = this.checked;
                            document.querySelectorAll('.check-item').forEach(cb => cb.checked = checked);
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
