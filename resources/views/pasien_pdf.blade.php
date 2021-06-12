<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF</title>
    <style>
        table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
        }

        thead {
            background-color: #f2f2f2;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }

        .tambah {
            padding: 8px 16px;
            text-decoration: none;
        }

    </style>

</head>

<body>
    <div style="overflow-x:auto;">
        <br>
        <center>
            <h2>Data Pasien</h2>
        </center>
        <br>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Tahun Buku</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; ?>
                @foreach ($pasien as $ps)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $ps->nama }}</td>
                        <td>{{ $ps->alamat }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
