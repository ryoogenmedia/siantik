<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DATA LAPORAN BULANAN PRESENSI</title>

    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        h4,
        h3 {
            text-align: center;
            margin: 0;
        }

        h4 {
            margin-bottom: 0;
        }

        h3 {
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 40px;
            font-size: 14px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }

        thead {
            background-color: rgb(226, 226, 226);
        }

        th {
            font-size: 12px;
        }

        td {
            text-align: center;
        }

        .badge {
            font-size: 10px;
            background-color: #ddd;
            padding: 2px 5px;
            border-radius: 3px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <h4>DATA LAPORAN BULANAN PRESENSI</h4>

    @if ($bulan)
        <h3>{{ strtoupper(config("const.month.$bulan")) }}</h3>
    @endif

    @if ($date_start && $date_end)
        <h3>{{ $date_start->format('d-m-Y') ?? '' }} {{ $date_end ? '-' : '' }} {{ $date_end->format('d-m-Y') ?? '' }}
        </h3>
    @endif

    <table>
        <thead>
            <tr>
                <th rowspan="2" style="text-align: center">NO</th>
                <th rowspan="2" style="text-align: center">NAMA</th>
                <th rowspan="2" style="text-align: center">NRP/NIP</th>
                <th colspan="7" style="text-align: center">KETERANGAN</th>
                <th rowspan="2" style="text-align: center">TOTAL</th>
            </tr>

            <tr>
                <th>H</th>
                <th>T</th>
                <th>S</th>
                <th>C</th>
                <th>I</th>
                <th>PK</th>
                <th>TR</th>
            </tr>

        </thead>
        <tbody>
            @foreach ($data as $absence)
                @php
                    $result = presensi($absence->id);
                @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td style="text-align: left">{{ $absence->name ?? '-' }}</td>
                    <td style="text-align: left">{{ $absence->personnel->number_identity ?? '-' }}</td>
                    <td>{{ $result['hadir'] }}</td>
                    <td>{{ $result['terlambat'] }}</td>
                    <td>{{ $result['sakit'] }}</td>
                    <td>{{ $result['cuti'] }}</td>
                    <td>{{ $result['izin'] }}</td>
                    <td>{{ $result['pendidikan'] }}</td>
                    <td>{{ $result['terlambat'] }}</td>
                    <td>{{ $result['total'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
