@extends('layouts.master')

@section('title', 'Transaksi Pembelian')

@push('css')
<style>
        .card-header {
        background: #007bff;
        color: white;
        padding: 20px;
    }

    .card-header h4 {
        font-family: 'Poppins', sans-serif;
        font-weight: bold;
    }

    .supplier-info {
        font-size: 1.2em;
    }

    .supplier-info td {
        padding: 5px 10px;
    }

    .tampil-bayar {
        font-size: 3em;
        text-align: center;
        padding: 20px;
        border-radius: 5px;
        background: #d4edda;
        color: #155724;
    }

    .tampil-terbilang {
        padding: 10px;
        background: #f8f9fa;
        border-radius: 5px;
        margin-top: 10px;
    }

    .btn-flat {
        border-radius: 50px;
        padding: 10px 20px;
    }

    .table-pembelian th, .table-pembelian td {
        text-align: center;
    }

    .table-pembelian thead {
        background: #007bff;
        color: white;
    }

    .form-group label {
        font-weight: bold;
    }

    .form-control[readonly] {
        background-color: #e9ecef;
    }

    @media (max-width: 768px) {
        .tampil-bayar {
            font-size: 2em;
        }
    }
    .tampil-bayar {
        font-size: 5em;
        text-align: center;
        height: 100px;

    }

    .tampil-terbilang {
        padding: 10px;
        background: #f0f0f0;
    }
    @media(max-width: 768px) {
        .tampil-bayar {
            font-size: 3em;
            height: 70px;
            padding-top: 5px;
        }    
    }

    .table-pembelian tbody tr:last-child {
        display: none;
    }
</style>
    
@endpush

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Transaksi Pembelian</li>
@endsection

@section('content')
    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <table class=""  >
                        <tr>
                            <h4>Supplier</h4>
                        </tr>
                        <tr>
                            <td>Nama</td>
                            <td>: {{ $supplier->nama }}</td>
                        </tr>
                        <tr>
                            <td>Telepon</td>
                            <td>: {{ $supplier->telepon }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>: {{ $supplier->alamat }}</td>
                        </tr>
                    </table>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form class="form-produk">
                        @csrf
                        <div class="form-group row">
                            <div class="col-lg-5">
                                <div class="input-group mb-3">
                                    <input class="invisible" type="hidden" name="id_pembelian" id="id_pembelian"
                                        value="{{ $id_pembelian }}">
                                    <input class="invisible" type="hidden" name="id_produk" id="id_produk">
                                    <div class="input-group-append">
                                        <button onclick="tampilproduk()" class="btn btn-info btn-flat" type="button"
                                            id="button-addon2"><i class="fa fa-table" aria-hidden="true"></i>
                                            Tampilkan Produk</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <table class="table table-striped table-bordered table-pembelian">
                        <thead class="text-center">
                            <tr>
                                <th width="4%">No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Ukuran</th>
                                <th>Harga</th>                               
                                <th width="12%">Jumlah</th>
                                <th>Subtotal</th>
                                <th width="8%"><i class="fa fa-cog"></i> Aksi</th>
                            </tr>
                        </thead>
                    </table>
                    
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="tampil-bayar bg-info text-center d-flex align-items-center justify-content-center"></div>
                            <div class="tampil-terbilang"></div>
                        </div>
                        <div class="col-lg-4">
                            <form action="{{ route('pembelian.store') }}" class="form-pembelian" method="post">
                                @csrf
                                <input type="hidden" name="id_pembelian" value="{{ $id_pembelian }}">
                                <input type="hidden" name="total" id="total">
                                <input type="hidden" name="total_item" id="total_item">
                                <input type="hidden" name="bayar" id="bayar">
                    
                                <div class="form-group row">
                                    <label for="totalrp" class="col-lg-4 col-form-label">Total</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="totalrp" class="form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="diskon" class="col-lg-4 col-form-label" >Diskon</label>
                                    <div class="col-lg-8">
                                        <input type="number" name="diskon" id="diskon" class="form-control" value="0">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bayar" class="col-lg-4 col-form-label">Bayar</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="bayarrp" class="form-control" readonly>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm btn-flat float-right btn-simpan"><i class="fa fa-check" aria-hidden="true"></i>
                            Simpan Transaksi</button>
                        <button type="button" onclick="cancelTransaction(`{{ route('pembelian.cancel', $id_pembelian) }}`)" class="btn btn-danger btn-sm btn-flat float-right mr-2"><i class="fa fa-times" aria-hidden="true"></i> Batal Transaksi</button>

                    </div>
                </div>
                <!-- ./card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    @includeIf('pembelian_detail.produk')
@endsection

@push('scripts')
    <script>
        let table, table2;
        $('body').addClass('sidebar-collapse');


        $(function() {
            table = $('.table-pembelian').DataTable({
/*                 processing: true,
 */                serverSide: true,
                    responsive: true,
                    autoWidth: false,
                    pagination: false,
                ajax: {
                    url: '{{ route('pembelian_detail.data', $id_pembelian) }}',
                },
                order: [],  // Menonaktifkan sorting default
                columnDefs: [
            { orderable: false, targets: 0 }  // Pastikan kolom pertama tidak bisa diurutkan
        ],

                columns: [{
                        data: 'DT_RowIndex',
                        searchable: false,
                        sortable: false
                    },
                    {
                        data: 'kode_produk'
                    },
                    {
                        data: 'nama_produk'
                    },
                    {
                        data: 'jenis'
                    },
                    {
                        data: 'harga_beli'
                    },
                    {
                        data: 'jumlah'
                    },
                    {
                        data: 'subtotal'
                    },
                    {
                        data: 'aksi',
                        searchable: false,
                        sortable: false
                    }
                ],
                dom: '',
                bSort: false,
            })
            .on('draw.dt', function () {
            loadForm($('#diskon').val());
        });
            table2 = $('.table-produk').DataTable();

            $(document).on('input', '.quantity', function() {
                let id = $(this).data('id');
                let jumlah = $(this).val();

                // Jika jumlah kurang dari 1, atur nilai kembali menjadi 1
                if (jumlah < 1) {
                    jumlah = 1;
                    $(this).val(jumlah).select(); // Atur nilai input menjadi 1
                }

                // Simpan nilai input ke local storage
                localStorage.setItem(`jumlah_${id}`, jumlah);

                $.post(`{{ url('/pembelian_detail') }}/${id}`, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'put',
                        'jumlah': jumlah
                    })
                    .done(response => {
                        table.ajax.reload(() => {
                            // Setelah tabel di-reload, kembalikan nilai input dari local storage
                            $('.quantity').each(function() {
                                let id = $(this).data('id');
                                let storedValue = localStorage.getItem(`jumlah_${id}`);
                                if (storedValue) {
                                    $(this).val(storedValue);
                                }
                            });
                            loadForm($('#diskon').val()); // Tambahkan baris ini untuk memuat ulang form
                        });
                    })
                    .fail(errors => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
            });
            $(document).on('input', '#diskon', function () {
            if ($(this).val() == "") {
                $(this).val(0).select();
            }

            loadForm($(this).val());
        });
        
        $('.btn-simpan').on('click', function () {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda akan menyimpan transaksi ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, simpan!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('.form-pembelian').submit();
                    }
                });
            });
        });

        function tampilproduk() {
            $('#modal-produk').modal('show');
        }

        function hideproduk() {
            $('#modal-produk').modal('hide');
        }

        function pilihProduk(id, kode) {
            $('#id_produk').val(id);
            $('#kode_produk').val(kode);
            hideproduk();
            
            Swal.fire({
                title: 'Produk Dipilih',
                text: 'Produk telah ditambahkan ke pembelian.',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    tambahProduk();
                }
            });
        }

        function tambahProduk() {
            $.post('{{ route('pembelian_detail.store') }}', $('.form-produk').serialize())
                .done(response => {
                    $('#kode_produk').focus();
                    table.ajax.reload(()=> loadForm($('#diskon').val())); // Reloads the table data without resetting pagination
                    $(`.quantity[data-id="${id}"]`).focus();

                })
                .fail(response => {
                    alert('Tidak dapat menyimpan data');
                    return;
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
                            table.ajax.reload(()=> loadForm($('#diskon').val()));
                            Swal.fire('Dihapus!', 'Data telah dihapus.', 'success');
                        })
                        .fail((errors) => {
                            Swal.fire('Gagal', 'Tidak dapat menghapus data', 'error');
                        });
                }
            });
        }
        
        function loadForm(diskon = 0) {
            $('#total').val($('.total').text());
            $('#total_item').val($('.total_item').text());

            $.get(`{{ url('/pembelian_detail/loadform') }}/${diskon}/${$('.total').text()}`)
            .done(response => {
                $('#totalrp').val(response.totalrp);
                $('#bayarrp').val(response.bayarrp);
                $('#bayar').val(response.bayar);
                $('.tampil-bayar').text(response.bayarrp);
                $('.tampil-terbilang').text(response.terbilang);
            })
            .fail(errors => {
                alert('Tidak dapat menampilkan data');
                return;
            })


        }

        function cancelTransaction(url) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Transaksi akan dibatalkan dan data akan dihapus!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, batalkan!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response) => {
                        window.location.href = '{{ route("pembelian.index") }}';
                    })
                    .fail((errors) => {
                        Swal.fire('Gagal', 'Tidak dapat membatalkan transaksi', 'error');
                    });
            }
        });
    }
    </script>
@endpush
