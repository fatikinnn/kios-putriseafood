<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota PDF</title>

    <style>
        table td {
            font-size: 14px;
        }
        table.data td,
        table.data th {
            border: 1px solid #ccc;
            padding: 5px;
        }
        table.data {
            border-collapse: collapse;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <table width="100%">
        <tr>
            <td rowspan="4" width="60%">
                <img src="{{ public_path($setting->path_logo) }}" alt="{{ $setting->path_logo }}" width="120">
                <br>
                {{ $setting->alamat }}
                <br>
                <br>
            </td>
            <td>Tanggal</td>
            <td>: {{ tanggal_indonesia(date('Y-m-d') ,false) }}</td>
        </tr>
        <tr>
            <td>Supplier</td>
            <td>: {{ $pembelian->supplier->nama ?? '' }}</td>
        </tr>
    </table>

    <table class="data" width="100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Ukuran</th>
                <th>Harga/Kilo</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detail as $key => $item)
                <tr>
                    <td class="text-center">{{ $key + 1 }}</td>
                    <td class="text-right">{{ $item->produk->nama_produk }}</td>
                    <td class="text-right">{{ $item->produk->jenis }}</td>
                    <td class="text-right">{{ format_uang($item->harga_beli) }}</td>
                    <td class="text-right">{{ formatkg($item->jumlah) }}</td>
                    <td class="text-right">{{ format_uang($item->subtotal) }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" class="text-right"><b>Total Harga</b></td>
                <td class="text-right"><b>{{ format_uang($pembelian->total_harga) }}</b></td>
            </tr>
            <tr>
                <td colspan="5" class="text-right"><b>Diskon</b></td>
                <td class="text-right"><b>{{ ($pembelian->diskon). '%' }}</b></td>
            </tr>
            <tr>
                <td colspan="5" class="text-right"><b>Total Bayar</b></td>
                <td class="text-right"><b>{{ format_uang($pembelian->bayar) }}</b></td>
            </tr>
        </tfoot>
    </table>

    <table width="100%">
        <tr>
            <td><b>Terimakasih dan sampai jumpa.</b></td>
            <td class="text-center">
                Kasir
                <br>
                <br>
                {{ auth()->user()->name }}
            </td>
        </tr>
    </table>
</body>
</html>
