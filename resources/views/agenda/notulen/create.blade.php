@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2>Buat Notulen</h2>
            </div>
            <div class="dashboard-content">
                <div class="card mb-2 mt-4">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('notulen.store') }}" method="POST">
                            @csrf

                            {{-- Input tersembunyi untuk agenda_id --}}
                            <input type="hidden" name="agenda_id" value="{{ request('agenda_id') }}">

                            <div class="mb-3">
                                <label for="pembicara" class="form-label">Pembicara</label>
                                <input type="text" name="pembicara" id="pembicara"
                                    class="form-control @error('pembicara') is-invalid @enderror"
                                    value="{{ old('pembicara') }}" required>
                                @error('pembicara')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="poin_pembahasan" class="form-label">Poin Pembahasan</label>
                                <textarea name="poin_pembahasan" id="poin_pembahasan" rows="4"
                                    class="form-control @error('poin_pembahasan') is-invalid @enderror" required></textarea>
                                @error('poin_pembahasan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="notulen" class="form-label">Isi Notulen</label>
                                <textarea name="notulen" id="notulen" rows="6" class="form-control @error('notulen') is-invalid @enderror"
                                    required>{{ old('notulen') }}</textarea>

                                @error('notulen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ url()->previous() }}" class="btn btn-danger">Kembali</a>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
