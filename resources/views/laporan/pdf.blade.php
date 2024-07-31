<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pendapatan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            margin: 0 auto;
            max-width: 800px;
            text-align: center;
        }

        h3, h4 {
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 5px;
            font-size: 10px;
        }

        table th {
            background-color: #f2f2f2;
            color: #333;
        }

        @media print {
            body {
                margin: 0;
                -webkit-print-color-adjust: exact;
            }

            .container {
                margin: 0;
                max-width: 100%;
            }

            h3, h4 {
                margin-bottom: 10px;
            }

            table {
                font-size: 8px;
                width: 100%;
            }

            table th, table td {
                padding: 4px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Laporan Pendapatan</h3>
        <h4>
            Tanggal {{ tanggal_indonesia($awal, false) }}
            s/d
            Tanggal {{ tanggal_indonesia($akhir, false) }}
        </h4>

        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th>Tanggal</th>
                    <th>Penjualan</th>
                    <th>Pembelian</th>
                    <th>Pengeluaran</th>
                    <th>Pendapatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
                    <tr>
                        @foreach ($row as $col)
                            <td>{{ $col }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
