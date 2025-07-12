<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Undangan Lelayu - {{ $undangan->nama_almarhum }}</title>
</head>

<body>
    <div style="border: 5px double black; padding: 20px;">
        <h3 align="center">LELAYU</h3>
        <p align="center"><strong>INNALILLAHI WA INNA ILAIHI ROOJI'UN</strong></p>

        <p align="center">Assalamu’alaikum Wr. Wb.</p>

        <p align="center">
            Sampun kapundhut wonten ngarsanipun Gusti Ingkang Maha Agung<br>
            kanthi tentrem jalaran gerah sakwetawis wedal:
        </p>

        <h4 align="center">{{ $undangan->nama_almarhum }}</h4>
        @if ($undangan->umur)
            <p align="center">Usia: {{ $undangan->umur }} tahun</p>
        @endif

        <table>
            <tr>
                <td>Rikolo dinten</td>
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

        <p><strong>Pamethaking layon kaangkah:</strong></p>

        <table>
            <tr>
                <td>Dinten</td>
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

        <p align="center">
            Nglenggana hambok bilih rikolo sugenipun almarhum hanggadhahi kalepatan dhumateng panjenengan sedaya,
            kapareng kulo sakulowarga ingkang nyuwunaken pangapunten.
        </p>

        <p align="center">Wassalamu’alaikum Wr. Wb.</p>

        <p><strong>Ingkang nandang duka:</strong></p>
        <ul>
            @foreach ($undangan->keluargas as $keluarga)
                <li>{{ $keluarga->nama }} ({{ ucfirst($keluarga->hubungan) }})</li>
            @endforeach
        </ul>
    </div>
</body>

</html>
