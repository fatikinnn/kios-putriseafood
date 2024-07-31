@extends('layouts.master')

@section('title', 'Daftar Supplier')


@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Daftar Supplier</li>
@endsection

@section('content')
    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button onclick="addForm('{{ route('supplier.store') }}')" class="btn btn-success btn-sm btn-flat float-right"><i class="fa fa-plus-circle"></i> Tambah</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive table-hover">
                    <table class="table table-stiped table-bordered">
                        <thead class="text-center">
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th width="13%"><i class="fa fa-cog"></i>Aksi</th>
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
    @includeIf('supplier.form')
@endsection

@push('scripts')
<script>
    let table;

    $(function() {
        table = $('.table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('supplier.data') }}',
            },
            order: [],  // Menonaktifkan sorting default
        columnDefs: [
            { orderable: false, targets: 0 }  // Pastikan kolom pertama tidak bisa diurutkan
        ],

            columns: [
                { data: 'DT_RowIndex', searchable: false, sortable: false},
                { data: 'nama' },
                { data: 'telepon' },
                { data: 'alamat' },
                { data: 'aksi', searchable: false, sortable: false}
            ]
        });
    });

    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah Supplier');
        
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama]').focus();
        
        $('#modal-form form').off('submit').on('submit', function(e) {
            e.preventDefault();
            $.post(url, $(this).serialize())
                .done((response) => {
                    $('#modal-form').modal('hide');
                    table.ajax.reload(null, false); // Reloads the table data without resetting pagination
                    Swal.fire('Berhasil', 'supplier berhasil ditambahkan', 'success');
                })
                .fail((errors) => {
                    Swal.fire('Gagal', 'Tidak dapat menambahkan supplier', 'error');
                });
        });
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Ubah Supplier');
        
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama]').focus();
        
        $.get(url)
            .done((response) => {
                $('#modal-form [name=nama]').val(response.nama);
                $('#modal-form [name=telepon]').val(response.telepon);
                $('#modal-form [name=alamat]').val(response.alamat);

            })
            .fail((errors) => {
                Swal.fire('Gagal', 'Tidak dapat menampilkan data', 'error');
            });
        
        $('#modal-form form').off('submit').on('submit', function(e) {
            e.preventDefault();
            $.post(url, $(this).serialize())
                .done((response) => {
                    $('#modal-form').modal('hide');
                    table.ajax.reload(null, false); // Reloads the table data without resetting pagination
                    Swal.fire('Berhasil', 'Kategori berhasil diperbarui', 'success');
                })
                .fail((errors) => {
                    Swal.fire('Gagal', 'Tidak dapat memperbarui kategori', 'error');
                });
        });
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

