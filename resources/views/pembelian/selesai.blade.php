@extends('layouts.master')

@section('title', 'Transaksi Pembelian')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Transaksi Pembelian</li>
@endsection

@section('content')
    <!-- Baris Utama -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check icon"> Transaksi selesai data telah disimpan</i>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="btn-group">
                        <button type="button" class="btn btn-warning btn-flat dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Cetak Nota
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" onclick="notaKecil('{{ route('pembelian_transaksi.nota_kecil') }}', 'Nota Kecil')">Nota Kecil</a>
                            <a class="dropdown-item" href="#" onclick="notaBesar('{{ route('pembelian_transaksi.nota_besar') }}', 'Nota Besar')">Nota Besar</a>
                        </div>
                    </div>
                    <a href="{{ route('pembelian.index') }}"><button class="btn btn-info btn-flat">Selesai</button></a>
                </div>
                <!-- ./card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection

@push('scripts')
<script>
    // Tambahkan untuk menghapus cookie innerHeight terlebih dahulu
    document.cookie = "innerHeight=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

    function notaKecil(url, title) {
        popupCenter(url, title, 625, 500);
    }

    function notaBesar(url, title) {
        popupCenter(url, title, 900, 675);
    }

    function popupCenter(url, title, w, h) {
        const dualScreenLeft = window.screenLeft !== undefined ? window.screenLeft : window.screenX;
        const dualScreenTop = window.screenTop !== undefined ? window.screenTop : window.screenY;

        const width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
        const height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

        const systemZoom = width / window.screen.availWidth;
        const left = (width - w) / 2 / systemZoom + dualScreenLeft
        const top = (height - h) / 2 / systemZoom + dualScreenTop
        const newWindow = window.open(url, title, 
        `
            scrollbars=yes,
            width=${w / systemZoom}, 
            height=${h / systemZoom}, 
            top=${top}, 
            left=${left}
        `
        );

        if (window.focus) newWindow.focus();
    }
</script>
@endpush
