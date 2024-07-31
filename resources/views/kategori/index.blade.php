@extends('layouts.master')

@section('title', 'Daftar Kategori')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Daftar Kategori</li>
@endsection

@section('content')
    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button onclick="addForm('{{ route('kategori.store') }}')" class="btn btn-success btn-sm btn-flat float-right"><i class="fa fa-plus-circle"></i> Tambah</button>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive table-hover">
                    <table class="table table-stiped table-bordered table-head-fixed text-nowrap">
                        <thead class="text-center">
                            <th width="7%">No</th>
                            <th>Kategori</th>
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
    @includeIf('kategori.form')
@endsection

@push('scripts')
<script>
    let table;

    $(function() {
        table = $('.table').DataTable({
            serverSide: true,
            responsive: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('kategori.data') }}',
            },
            columns: [
                { data: 'DT_RowIndex', searchable: false, sortable: false},
                { data: 'nama_kategori' },
                { data: 'aksi', searchable: false, sortable: false}
            ],
            order: [],  // Menonaktifkan sorting default
            columnDefs: [
            { orderable: false, targets: 0 }  // Pastikan kolom pertama tidak bisa diurutkan
        ]

        });
    });

    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah Kategori');
        
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama_kategori]').focus();
        
        $('#modal-form form').off('submit').on('submit', function(e) {
            e.preventDefault();
            $.post(url, $(this).serialize())
                .done((response) => {
                    $('#modal-form').modal('hide');
                    table.ajax.reload(null, false); // Reloads the table data without resetting pagination
                    Swal.fire('Berhasil', 'Kategori berhasil ditambahkan', 'success');
                })
                .fail((errors) => {
                    Swal.fire('Gagal', 'Tidak dapat menambahkan kategori', 'error');
                });
        });
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Kategori');
        
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama_kategori]').focus();
        
        $.get(url)
            .done((response) => {
                $('#modal-form [name=nama_kategori]').val(response.nama_kategori);
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

