@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@push('css')
<style>
    .card-body {
        background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);
        color: #333;
        border-radius: 15px;
        padding: 40px;
    }

    .card-body h1, .card-body h2, .card-body h3 {
        font-family: 'Poppins', sans-serif;
        font-weight: bold;
    }

    .card-body h1 {
        font-size: 3em;
        margin-bottom: 20px;
    }

    .card-body h2 {
        font-size: 2em;
        margin-bottom: 20px;
    }

    .card-body h3 {
        font-size: 1.5em;
        margin-bottom: 40px;
    }

    .btn-lg {
        padding: 15px 30px;
        font-size: 1.5em;
        border-radius: 50px;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-lg:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .card {
        border: none;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .badge-primary {
        background-color: #5a67d8;
    }
</style>
@endpush

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-body text-center">
                    <h1>Selamat Datang, {{ auth()->user()->name }}!</h1>
                    <h2>Anda Masuk Sebagai <span class="badge badge-pill badge-primary">KASIR</span></h2>
                    <h3>Pendapatan Hari Ini: <strong>{{ $pendapatanHariIni }}</strong></h3>
                    <a href="{{ route('transaksi.baru') }}" class="btn btn-success btn-lg mt-4">Transaksi Baru</a>
                </div>
            </div>
        </div>
    </div>
@endsection
