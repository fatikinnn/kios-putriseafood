@extends('layouts.master')

@section('title', 'Daftar Pembelian')


@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Daftar Pembelian</li>
@endsection

@section('content')
    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button onclick="addForm()" class="btn btn-success btn-sm btn-flat float-right"><i class="fa fa-plus-circle"></i>Transaksi Baru</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive table-hover">
                    <table class="table table-stiped table-bordered table-pembelian">
                        <thead class="text-center">
                            <th width="5%">No</th>
                            <th>Tanggal</th>
                            <th>Supplier</th>
                            <th>Jumlah</th>
                            <th>Total Harga</th>
                            <th>Diskon</th>
                            <th>Total Bayar</th>
                            <th width="14%"><i class="fa fa-cog"></i>Aksi</th>
                        </thead>
                    </table>
                </div>
                <!-- ./card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    @includeIf('pembelian.supplier')
    @includeIf('pembelian.detail')

@endsection

@push('scripts')
<script>
    let table, table1;

    $(function () {
        table = $('.table-pembelian').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('pembelian.data') }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'tanggal'},
                {data: 'supplier'},
                {data: 'total_item'},
                {data: 'total_harga'},
                {data: 'diskon'},
                {data: 'bayar'},
                {data: 'aksi', searchable: false, sortable: false},
            ],
            order: [],  // Menonaktifkan sorting default
        columnDefs: [
            { orderable: false, targets: 0 }  // Pastikan kolom pertama tidak bisa diurutkan
        ]

        });

        $('.table-supplier').DataTable();
        table1 = $('.table-detail').DataTable({
            bSort: false,
            dom: '',
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'kode_produk'},
                {data: 'nama_produk'},
                {data: 'jenis'},
                {data: 'harga_beli'},
                {data: 'jumlah'},
                {data: 'subtotal'},
            ],
            order: [],  // Menonaktifkan sorting default
            columnDefs: [
            { orderable: false, targets: 0 }  // Pastikan kolom pertama tidak bisa diurutkan
        ]

        })
    });

    

    function addForm() {
        $('#modal-supplier').modal('show');
        
    }

    function showDetail(url) {
        $('#modal-detail').modal('show');

        table1.ajax.url(url);
        table1.ajax.reload();
    }

    function deleteData(url) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(url, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'delete'
                })
                .done((response) => {
                    table.ajax.reload(null, false); // Reloads the table data without resetting pagination
                    Swal.fire('Dihapus!', 'Data telah dihapus.', 'success');
                })
                .fail((errors) => {
                    Swal.fire('Gagal', 'Tidak dapat menghapus data', 'error');
                });
            }
        });
    }
</script>
@endpush

