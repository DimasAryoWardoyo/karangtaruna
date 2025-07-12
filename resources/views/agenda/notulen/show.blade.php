@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2>Detail Notulen</h2>
            </div>

            <div class="dashboard-content">
                <div class="card mt-4 mb-2">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                {{-- Pembicara --}}
                                <tr>
                                    <th style="width: 20%">Pembicara</th>
                                    <td>{{ $notulen->pembicara }}</td>
                                </tr>

                                {{-- Isi Notulen --}}
                                <tr>
                                    <th>Notulen</th>
                                    <td>{!! nl2br(e($notulen->notulen)) !!}</td>
                                </tr>

                                {{-- Poin Pembahasan --}}
                                @if (!empty($notulen->poin_pembahasan))
                                    <tr>
                                        <th>Poin Pembahasan</th>
                                        <td>{!! nl2br(e($notulen->poin_pembahasan)) !!}</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                        {{-- Tombol Kembali --}}
                        <a href="{{ route('agenda.anggota.show', $notulen->agenda_id) }}" class="btn btn-danger mt-3">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
