@extends('layouts.master')

@section('title', 'Transaksi Penjualan')

@push('css')
<style>
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
</style>
    
@endpush

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Transaksi Penjualan</li>
@endsection

@section('content')
    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body ">
                    <form class="form-produk">
                        @csrf
                        <div class="form-group row">
                            <div class="col-lg-5">
                                <div class="input-group mb-2">
                                    <input class="invisible" type="hidden" name="id_penjualan" id="id_penjualan"
                                        value="{{ $id_penjualan }}">
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
                    <table class="table table-stiped table-bordered table-pembelian">
                        <thead class="text-center">
                            <tr>
                                <th width="7%">No</th>
                                <th>Kode</th>
                                <th>Nama</th>
                                <th>Ukuran</th>
                                <th>Harga</th>
                                <th width="12%">Jumlah (Kg)</th>
                                <th>Diskon</th>
                                <th>Subtotal</th>
                                <th width="7%"><i class="fa fa-cog"></i> Aksi</th>
                            </tr>
                        </thead>
                    </table>
                    
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="tampil-bayar bg-info text-center d-flex align-items-center justify-content-center"></div>
                            <div class="tampil-terbilang"></div>
                        </div>
                        <div class="col-lg-4">
                            <form action="{{ route('transaksi.simpan') }}" class="form-penjualan" method="post">
                                @csrf
                                <input type="hidden" name="id_penjualan" value="{{ $id_penjualan }}">
                                <input type="hidden" name="total" id="total">
                                <input type="hidden" name="total_item" id="total_item">
                                <input type="hidden" name="bayar" id="bayar">
                                <input type="hidden" name="id_member" id="id_member">
                    
                                <div class="form-group row">
                                    <label for="totalrp" class="col-lg-4 col-form-label">Total</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="totalrp" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kode_member" class="col-lg-4 col-form-label">Member</label>
                                    <div class="col-lg-8">
                                        <div class="input-group mb-1">
                                            <input class="form-control" type="text" id="kode_member" readonly>
                                            <div class="input-group-append">
                                                <button onclick="tampilMember()" class="btn btn-info" type="button"
                                                    id="button-addon4"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="diskon" class="col-lg-4 col-form-label">Diskon</label>
                                    <div class="col-lg-8">
                                        <input type="number" name="diskon" id="diskon" class="form-control" value="0">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bayar" class="col-lg-4 col-form-label">Total Harga</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="bayarrp" class="form-control" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="diterima" class="col-lg-4 col-form-label">Diterima</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="diterima" name="diterima" class="form-control" value="0">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="kembali" class="col-lg-4 col-form-label">Kembali</label>
                                    <div class="col-lg-8">
                                        <input type="text" id="kembali" name="kembali" class="form-control" readonly value="0">
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm btn-flat float-right btn-simpan"><i class="fa fa-check" aria-hidden="true"></i>
                            Simpan Transaksi</button>
                        <button type="button" onclick="cancelTransaction(`{{ route('penjualan.cancel', $id_penjualan) }}`)" class="btn btn-danger btn-sm btn-flat float-right mr-2"><i class="fa fa-times" aria-hidden="true"></i> Batal Transaksi</button>

                    </div>
                </div>
                <!-- ./card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    @includeIf('penjualan_detail.produk')
    @includeIf('penjualan_detail.member')

@endsection

@push('scripts')
    <script>
          let table, table2;
    $('body').addClass('sidebar-collapse');

    $(function() {
        table = $('.table-pembelian').DataTable({
            serverSide: true,
            responsive: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('transaksi.data', $id_penjualan) }}',
            },
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'kode_produk'},
                {data: 'nama_produk'},
                {data: 'jenis'},
                {data: 'harga_jual'},
                {data: 'jumlah'},
                {data: 'diskon'},
                {data: 'subtotal'},
                {data: 'aksi', searchable: false, sortable: false}
            ],
            dom: '',
            bSort: false,
            paginate: false,
        }).on('draw.dt', function () {
            loadForm($('#diskon').val());
            setTimeout(() => {
                $('#diterima').trigger('input');
            }, 300);
        });

        table2 = $('.table-produk').DataTable();

        $(document).on('input', '.quantity', function() {
            let id = $(this).data('id');
            let jumlah = $(this).val();

            if (jumlah < 1) {
                jumlah = 1;
                $(this).val(jumlah);
            }

            localStorage.setItem(`jumlah_${id}`, jumlah);

            $.post(`{{ url('/transaksi') }}/${id}`, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'put',
                    'jumlah': jumlah
                })
                .done(response => {
                    table.ajax.reload(() => {
                        $('.quantity').each(function() {
                            let id = $(this).data('id');
                            let storedValue = localStorage.getItem(`jumlah_${id}`);
                            if (storedValue) {
                                $(this).val(storedValue);
                            }
                        });
                        loadForm($('#diskon').val());
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

        $('#diterima').on('input', function () {
            let diterima = parseFloat($(this).val().replace(/[^,\d]/g, '')) || 0;
            $(this).val(formatRupiah(diterima.toString(), 'Rp '));
            loadForm($('#diskon').val(), diterima);
        }).focus(function () {
            $(this).select();
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
                    $('.form-penjualan').submit();
                }
            });
        });
    });

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp ' + rupiah : '');
    }

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

    function tampilMember() {
        $('#modal-member').modal('show');
    }

    function pilihMember(id, kode) {
        $('#id_member').val(id);
        $('#kode_member').val(kode);
        $('#diskon').val('{{ $diskon }}');
        loadForm($('#diskon').val());
        $('#modal-member').on('hidden.bs.modal', function () {
            $('#diterima').focus().select();
        });
        hideMember();
    }

    function hideMember() {
        $('#modal-member').modal('hide');
    }

    function tambahProduk() {
        $.post('{{ route('transaksi.store') }}', $('.form-produk').serialize())
            .done(response => {
                $('#kode_produk').focus();
                table.ajax.reload(() => loadForm($('#diskon').val()));
            })
            .fail(response => {
                alert('Tidak dapat menyimpan data');
                return;
            });
    }

    function deleteData(url) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data akan dihapus!",
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
                        table.ajax.reload(() => loadForm($('#diskon').val()));
                        Swal.fire('Dihapus!', 'Data telah dihapus.', 'success');
                    })
                    .fail((errors) => {
                        Swal.fire('Gagal', 'Tidak dapat menghapus data', 'error');
                    });
            }
        });
    }

    function loadForm(diskon = 0, diterima = 0) {
        $('#total').val($('.total').text());
        $('#total_item').val($('.total_item').text());

        $.get(`{{ url('/transaksi/loadform') }}/${diskon}/${$('.total').text()}/${diterima}`)
            .done(response => {
                $('#totalrp').val(response.totalrp);
                $('#bayarrp').val(response.bayarrp);
                $('#bayar').val(response.bayar);
                $('.tampil-bayar').text('Bayar: ' + response.bayarrp);
                $('.tampil-terbilang').text(response.terbilang);

                $('#kembali').val(response.kembalirp);
                if (diterima != 0) {
                    $('.tampil-bayar').text('Kembali: ' + response.kembalirp);
                    $('.tampil-terbilang').text(response.kembali_terbilang);
                }
            })
            .fail(errors => {
                alert('Tidak dapat menampilkan data');
                return;
            });
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
                        window.location.href = '{{ route("penjualan.index") }}';
                    })
                    .fail((errors) => {
                        Swal.fire('Gagal', 'Tidak dapat membatalkan transaksi', 'error');
                    });
            }
        });
    }
    
    </script>
@endpush
