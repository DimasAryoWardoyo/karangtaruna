@extends('layouts.dashboard')


@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 text-gray-800 mb-0">Daftar Hadir: {{ $agenda->nama_agenda }}</h1>

        <!-- Tombol kembali -->
        <a href="{{ route('agenda.admin.show', $agenda->id) }}" class="btn btn-sm btn-danger rounded shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Kembali
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-sm-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold">Laporan Kehadiran</h6>

            <!-- Tombol print (DataTables Buttons) -->
            <button onclick="printDaftarHadir()" class="btn btn-sm btn-info shadow-sm">
                <i class="fas fa-print fa-sm text-white-50"></i> Print
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="presensi-table" class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="thead-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Waktu Presensi</th>
                            <th>Token</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($presensi as $index => $data)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $data->user->name ?? 'Tidak Diketahui' }}</td>
                                <td>{{ $data->waktu_presensi }}</td>
                                <td>{{ $data->token_yang_dipakai }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
            $('#presensi-table').DataTable({
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

    <script>
        function printDaftarHadir() {
            window.print();
        }
    </script>

    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #presensi-table,
            #presensi-table * {
                visibility: visible;
            }

            #presensi-table {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }

            .d-print-none {
                display: none !important;
            }
        }
    </style>
@endsection
