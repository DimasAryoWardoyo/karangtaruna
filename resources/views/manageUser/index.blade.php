@extends('layouts.dashboard')

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
        <div class="container-fluid">
            <div class="dashboard-heading">
                <h2 class="dashboard-title">Kelola User</h2>
                <p class="dashboard-subtitle">Strategi Efektif dalam Manajemen User</p>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow-sm border-0 mb-3">
                            <div class="card-body">
                                @if (Auth::user()->role === 'admin')
                                    <a href="{{ route('manageUsers.create') }}" class="btn mb-3 btn-warning">
                                        Tambah User <i class="fa fa-plus-square" aria-hidden="true"></i>
                                    </a>
                                @endif
                                @if (session('success'))
                                    <div class="alert alert-success">{{ session('success') }}</div>
                                @endif
                                <div class="table-responsive">
                                    <table id="usersTable" class="table table-bordered table-hover">
                                        <thead class="table-secondary">
                                            <tr class="text-center">
                                                <th>Nama</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td class="text-center">{{ $user->role }}</td>
                                                    <td class="text-center">
                                                        <a href="{{ route('manageUsers.show', $user->id) }}"
                                                            class="btn btn-sm btn-info"><i
                                                                class="fas fa-info-circle"></i></a>
                                                        <a href="{{ route('manageUsers.edit', $user->id) }}"
                                                            class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                                        <form action="{{ route('manageUsers.destroy', $user->id) }}"
                                                            method="POST" style="display:inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger"
                                                                onclick="return confirm('Yakin ingin hapus user ini?')"><i
                                                                    class="fas fa-trash-alt"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ url('https://code.jquery.com/jquery-3.7.0.min.js') }}"></script>
    <script src="{{ url('https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js') }}"></script>
    <script src="{{ url('https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js') }}"></script>
    <script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
                dom: 'Bfrtip',
                buttons: ['excelHtml5', 'print'],
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    paginate: {
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    },
                    zeroRecords: "Tidak ada data yang ditemukan"
                }
            });
        });
    </script>
@endsection
