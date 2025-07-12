@extends('layouts.dashboard')

@section('content')
    <div class="container-fluid">

        <!-- Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 mb-0 text-gray-800 font-weight-bold">Detail User</h1>
        </div>

        <!-- Card -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered mb-4">
                        <tbody>
                            <tr>
                                <th style="width: 200px;">Nama</th>
                                <td>{{ $user->name }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td>{{ ucfirst($user->role) }}</td>
                            </tr>
                            @if ($user->identitas)
                                <tr>
                                    <th>No WhatsApp</th>
                                    <td>{{ $user->identitas->no_whatsapp }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir</th>
                                    <td>{{ \Carbon\Carbon::parse($user->identitas->tanggal_lahir)->format('d M Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>{{ $user->identitas->status }}</td>
                                </tr>
                                <tr>
                                    <th>Alasan</th>
                                    <td>{{ $user->identitas->alasan ?? '-' }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                <a href="{{ route('manageUsers.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>
@endsection
