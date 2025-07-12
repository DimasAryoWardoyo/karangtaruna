@extends('layouts.dashboard')

@section('content')
    <div class="container">
        {{-- Area Undangan --}}
        <div id="print-area" class="border p-4" style="border: 5px double black; font-family: 'DejaVu Sans', sans-serif;">
            <div class="text-center mb-3">
                <h4><strong>LELAYU</strong></h4>
                <p><strong>INNALILAHI WA INNA ILAIHI ROOJI'UN</strong></p>
            </div>

            <p class="text-center">Assalamu’alaikum Wr. Wb.</p>
            <p class="text-center">
                Sampun kapundhut wangsu wonten ngarsanipun Gusti Ingkang Maha Agung<br>
                kanthi tentrem jalaran gerah sakwetawis wedal:
            </p>

            <h5 class="text-center mt-3"><strong>{{ $undangan->nama_almarhum }}</strong></h5>

            @if ($undangan->umur)
                <p class="text-center"><strong>Dumugi yuswo {{ $undangan->umur }} tahun</strong></p>
            @endif

            <table class="mx-auto mt-4 mb-3" style="width: 80%;">
                <tr>
                    <td width="35%">Rikolo dinten</td>
                    <td>: {{ \Carbon\Carbon::parse($undangan->hari_wafat)->translatedFormat('l, d F Y') }}</td>
                </tr>
                <tr>
                    <td>Wanci tabuh</td>
                    <td>: {{ \Carbon\Carbon::parse($undangan->jam_wafat)->format('H:i') }} WIB</td>
                </tr>
                <tr>
                    <td>Wonten ing</td>
                    <td>: {{ $undangan->lokasi_wafat }}</td>
                </tr>
            </table>

            <h6 class="text-center"><strong>Pamethaking layon kaangkah:</strong></h6>

            <table class="mx-auto mt-3 mb-3" style="width: 80%;">
                <tr>
                    <td width="35%">Dinten</td>
                    <td>: {{ \Carbon\Carbon::parse($undangan->hari_pemakaman)->translatedFormat('l, d F Y') }}</td>
                </tr>
                <tr>
                    <td>Wanci tabuh</td>
                    <td>: {{ \Carbon\Carbon::parse($undangan->jam_pemakaman)->format('H:i') }} WIB</td>
                </tr>
                <tr>
                    <td>Saking griyo dukhito</td>
                    <td>: {{ $undangan->lokasi_wafat }}</td>
                </tr>
                <tr>
                    <td>Wonten</td>
                    <td>: {{ $undangan->tempat_pemakaman }}</td>
                </tr>
            </table>

            <p class="text-center mt-3">
                Nglenggana hambok bilih rikolo sugenipun almarhum hanggadhahi kalepatan dhumateng panjenengan sedaya,<br>
                kapareng kulo sakulowarga ingkang nyuwunaken pangapunten.
            </p>

            <p class="text-center mt-3">Wassalamu’alaikum Wr. Wb.</p>

            @if ($undangan->keluargas->count())
                <p class="mt-4"><strong>Ingkang nandang dhuhkito :</strong></p>
                <ul style="padding-left: 20px;">
                    @foreach ($undangan->keluargas as $keluarga)
                        <li>{{ $keluarga->nama }} ({{ ucfirst($keluarga->hubungan) }})</li>
                    @endforeach
                </ul>
            @endif
        </div>

        {{-- Tombol Aksi (hanya tampil di layar) --}}
        <div class="mt-4 d-print-none">
            <a href="{{ route('undangan.index') }}" class="btn btn-secondary">Kembali</a>
            <a href="{{ route('undangan.pdf', $undangan->id) }}" class="btn btn-danger">Export ke PDF</a>
            <button onclick="printUndangan()" class="btn btn-success">Print</button>
        </div>
    </div>
    <script>
        function printUndangan() {
            window.print();
        }
    </script>

    {{-- Hanya cetak bagian isi --}}
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            #print-area,
            #print-area * {
                visibility: visible;
            }

            #print-area {
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
