@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2>Edit Notulen</h2>
            </div>

            <div class="dashboard-content">
                <div class="card mb-2 mt-4">
                    <div class="card-body">
                        <form action="{{ route('notulen.update', $notulen->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            {{-- Pembicara --}}
                            <div class="mb-3">
                                <label for="pembicara" class="form-label">Pembicara</label>
                                <input type="text" name="pembicara" id="pembicara"
                                    class="form-control @error('pembicara') is-invalid @enderror"
                                    value="{{ old('pembicara', $notulen->pembicara) }}" required>
                                @error('pembicara')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Isi Notulen --}}
                            <div class="mb-3">
                                <label for="notulen" class="form-label">Isi Notulen</label>
                                <textarea name="notulen" id="notulen" rows="6" class="form-control @error('notulen') is-invalid @enderror"
                                    required>{{ old('notulen', $notulen->notulen) }}</textarea>
                                @error('notulen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Poin Pembahasan --}}
                            <div class="mb-3">
                                <label for="poin_pembahasan" class="form-label">Poin Pembahasan</label>
                                <textarea name="poin_pembahasan" id="poin_pembahasan" rows="4"
                                    class="form-control @error('poin_pembahasan') is-invalid @enderror">{{ old('poin_pembahasan', $notulen->poin_pembahasan) }}</textarea>
                                @error('poin_pembahasan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tombol --}}
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('agenda.admin.show', $notulen->agenda_id) }}" class="btn btn-danger">Kembali</a>
                                <button type="submit" class="btn btn-success">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
