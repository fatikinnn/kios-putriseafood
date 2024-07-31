@extends('layouts.print')

@section('content')
    <h1>Nota Pembelian</h1>
    <table class="table no-border">
        <tr>
            <th>Supplier</th>
            <td>{{ $pembelian->supplier->nama }}</td>
        </tr>
        <tr>
            <th>Tanggal</th>
            <td>{{ $pembelian->created_at }}</td>
        </tr>
        <tr>
            <th>Total</th>
            <td>{{ $pembelian->total }}</td>
        </tr>
    </table>

    <h2>Detail Pembelian</h2>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($details as $detail)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $detail->produk->nama }}</td>
                    <td>{{ $detail->harga_beli }}</td>
                    <td>{{ $detail->jumlah }}</td>
                    <td>{{ $detail->subtotal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
