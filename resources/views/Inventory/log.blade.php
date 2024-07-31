@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Log Pembelian</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Tipe Transaksi</th>
                <th>User</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($logs as $log)
                <tr>
                    <td>{{ $log->id_inventory }}</td>
                    <td>{{ $log->produk->nama_produk }}</td>
                    <td>{{ $log->jumlah }}</td>
                    <td>{{ $log->keterangan }}</td>
                    <td>{{ $log->tipe_transaksi }}</td>
                    <td>{{ $log->user->name }}</td>
                    <td>{{ $log->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
