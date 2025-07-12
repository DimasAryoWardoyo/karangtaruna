<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Undangan Lelayu - {{ $undangan->nama_almarhum }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            margin: 20px;
        }

        .border-double {
            border: 4px double black;
            padding: 20px 30px;
        }

        .text-center {
            text-align: center;
        }

        h4,
        p {
            margin: 4px 0;
        }

        table {
            margin-top: 10px;
            width: 80%;
        }

        table.align-center {
            margin-left: auto;
            margin-right: auto;
        }

        td {
            vertical-align: top;
            padding: 2px 4px;
        }

        ul {
            padding-left: 20px;
            margin-top: 8px;
        }

        .section-title {
            font-weight: bold;
            text-align: center;
            margin-top: 14px;
        }
    </style>
</head>

<body>
    <div class="border-double">
        <div class="text-center">
            <h4>LELAYU</h4>
            <p><strong>INNALILLAHI WA INNA ILAIHI ROOJI'UN</strong></p>
        </div>

        <p class="text-center">Assalamu’alaikum Wr. Wb.</p>

        <p class="text-center">
            Sampun kapundhut wonten ngarsanipun Gusti Ingkang Maha Agung<br>
            kanthi tentrem jalaran gerah sakwetawis wedal:
        </p>

        <h4 class="text-center" style="margin-top: 10px;">{{ $undangan->nama_almarhum }}</h4>
        @if ($undangan->umur)
            <p class="text-center">Dumugi yuswo {{ $undangan->umur }} tahun</p>
        @endif

        <!-- Info Wafat -->
        <table class="align-center">
            <tr>
                <td width="30%">Rikolo dinten</td>
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

        <!-- Info Pemakaman -->
        <p class="section-title">Pamethaking layon kaangkah:</p>

        <table class="align-center">
            <tr>
                <td width="30%">Dinten</td>
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

        <!-- Kalimat Penutup -->
        <p class="text-center" style="margin-top: 10px;">
            Nglenggana hambok bilih rikolo sugenipun almarhum hanggadhahi kalepatan dhumateng panjenengan sedaya,
            kapareng kulo sakulowarga ingkang nyuwunaken pangapunten.
        </p>

        <p class="text-center" style="margin-top: 5px;">Wassalamu’alaikum Wr. Wb.</p>

        <!-- Keluarga -->
        @if ($undangan->keluargas->count())
            <p style="margin-top: 10px;"><strong>Ingkang nandang duka:</strong></p>
            <ul>
                @foreach ($undangan->keluargas as $keluarga)
                    <li>{{ $keluarga->nama }} ({{ ucfirst($keluarga->hubungan) }})</li>
                @endforeach
            </ul>
        @endif
    </div>
</body>

</html>
