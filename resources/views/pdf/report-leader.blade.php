<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DATA LAPORAN HARIAN PRESENSI</title>

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
    <h4>DATA LAPORAN HARIAN PRESENSI</h4>

    @if ($date_start && $date_end)
        <h3>{{ $date_start->format('d-m-Y') ?? '' }} {{ $date_end ? '-' : '' }} {{ $date_end->format('d-m-Y') ?? '' }}
        </h3>
    @endif

    <table>
        <thead>
            <tr>
                <th style="text-align: center">NO</th>
                <th style="text-align: center">NAMA</th>
                <th style="text-align: center">NRP/NIP</th>
                <th style="text-align: center">JABATAN</th>
                <th style="text-align: center">STATUS PRESENSI</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $absence)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td style="text-align: left">{{ $absence->name ?? '-' }}</td>
                    <td style="text-align: left">{{ $absence->personnel->number_identity ?? '-' }}</td>
                    <td style="text-align: left">{{ $absence->personnel->position ?? '-' }}</td>
                    <td style="text-align: left">{{ $absence->attendances->first()->status_attendance ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
