@extends('layouts.master')

@section('title', 'Daftar Produk')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Daftar Produk</li>
@endsection

@section('content')
    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="btn-group float-right">
                        <button onclick="addForm('{{ route('produk.store') }}')" class="btn btn-success btn-sm btn-flat mr-2"><i class="fa fa-plus-circle"></i>Tambah</button>

                        <button onclick="deleteSelected('{{route ('produk.delete_selected')}}')" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-trash"></i>Hapus</button>

                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <form action="" class="form-produk">
                        @csrf
                        <table class="table table-stiped table-bordered table-hover">
                            <thead class="text-center">
                                <th>
                                    <input type="checkbox" name="select_all" id="select_all">
                                </th>
                                <th width="2%">No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Jenis</th>
                                <th>Ukuran</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Stok</th>
                                <th width="14%"><i class="fa fa-cog"></i>Aksi</th>
                            </thead>
                        </table>
                    </form>
                </div>
                <!-- ./card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    @includeIf('produk.form')
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
                url: '{{ route('produk.data') }}',
            },
            order: [],  // Menonaktifkan sorting default
            columnDefs: [
            { orderable: false, targets: 0 }  // Pastikan kolom pertama tidak bisa diurutkan
        ],

            columns: [
                { data: 'select_all', searchable: false, sortable: false },
                { data: 'DT_RowIndex', searchable: false, sortable: false},
                { data: 'kode_produk' },
                { data: 'nama_produk' },
                { data: 'nama_kategori' },
                { data: 'jenis' },
                { data: 'harga_beli' },
                { data: 'harga_jual' },
                { data: 'stok' },
                { data: 'aksi', searchable: false, sortable: false}
            ]
        });
        $('[name=select_all]').on('click', function () {
            $(':checkbox').prop('checked', this.checked);
        });
    });

    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah Produk');
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama_produk]').focus();
        $('#modal-form form').off('submit').on('submit', function(e) {
            e.preventDefault();
            $.post(url, $(this).serialize())
                .done((response) => {
                    $('#modal-form').modal('hide');
                    table.ajax.reload(null, false);
                    Swal.fire('Berhasil', 'Data berhasil ditambahkan', 'success');
                })
                .fail((errors) => {
                    Swal.fire('Gagal', 'Tidak dapat menambahkan data', 'error');
                });
        });
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Ubah Produk');
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama_produk]').focus();

        $.get(url)
            .done((response) => {
/*                 $('#modal-form [name=kode_produk]').val(response.kode_produk);
 */                $('#modal-form [name=nama_produk]').val(response.nama_produk);
                $('#modal-form [name=id_kategori]').val(response.id_kategori);
                $('#modal-form [name=jenis]').val(response.jenis);
                $('#modal-form [name=harga_beli]').val(response.harga_beli);
                $('#modal-form [name=harga_jual]').val(response.harga_jual);
                $('#modal-form [name=diskon]').val(response.diskon);
                $('#modal-form [name=stok]').val(response.stok);
            })
            .fail((errors) => {
                Swal.fire('Gagal', 'Tidak dapat menampilkan data', 'error');
            });

        $('#modal-form form').off('submit').on('submit', function(e) {
            e.preventDefault();
            $.post(url, $(this).serialize())
                .done((response) => {
                    $('#modal-form').modal('hide');
                    table.ajax.reload(null, false);
                    Swal.fire('Berhasil', 'Data berhasil diperbarui', 'success');
                })
                .fail((errors) => {
                    Swal.fire('Gagal', 'Tidak dapat memperbarui data', 'error');
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
                    table.ajax.reload(null, false);
                    Swal.fire('Dihapus!', 'Data telah dihapus.', 'success');
                })
                .fail((errors) => {
                    Swal.fire('Gagal', 'Tidak dapat menghapus data', 'error');
                });
            }
        });
    }

    function deleteSelected(url) {
        if ($('input:checked').length > 1) {
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
                    $.post(url, $('.form-produk').serialize())
                        .done((response) => {
                            table.ajax.reload(null, false);
                            Swal.fire('Dihapus!', 'Data telah dihapus.', 'success');
                        })
                        .fail((errors) => {
                            Swal.fire('Gagal', 'Tidak dapat menghapus data', 'error');
                        });
                }
            });
        } else {
            Swal.fire('Gagal', 'Pilih data yang akan dihapus', 'error');
        }
    }
</script>
@endpush

