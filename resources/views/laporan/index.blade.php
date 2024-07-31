@extends('layouts.master')

@section('title')
Laporan Pendapatan {{tanggal_indonesia($tanggalAwal, false) }} s/d {{tanggal_indonesia($tanggalAkhir, false) }}
@endsection

@push('css')
<link rel="stylesheet" href="{{ asset('lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
<link rel="stylesheet" href="{{ asset('lte/plugins/daterangepicker/daterangepicker.css') }}">
@endpush

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Laporan</li>
@endsection

@section('content')
    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <button onclick="updatePeriode()" class="btn btn-info btn-sm btn-flat"><i class="fa fa-calendar"></i> Ubah Periode</button>
                    <button onclick="resetTable()" class="btn btn-warning btn-sm btn-flat"><i class="fa fa-undo"></i>Ulang</button>

{{--                     <a href="{{ route('laporan.export_pdf', [$tanggalAwal, $tanggalAkhir]) }}" target="_blank" class="btn btn-success btn-xs btn-flat"><i class="fa fa-file-excel-o"></i> Export PDF</a>
 --}}                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive table-hover">
                    <table class="table table-stiped table-bordered">
                        <thead>
                            <th width="5%">No</th>
                            <th>Tanggal</th>
                            <th>Penjualan</th>
                            <th>Pembelian</th>
                            <th>Pengeluaran</th>
                            <th>Pendapatan</th>
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
    @includeIf('laporan.form')
@endsection

@push('scripts')
<script src="{{ asset('lte/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('lte/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('lte/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script>
    let table;
    let defaultStartDate = '{{ date('Y-m-01') }}';
    let defaultEndDate = '{{ date('Y-m-d') }}';

    $(function () {
        table = $('.table').DataTable({
            responsive: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('laporan.data', [$tanggalAwal, $tanggalAkhir]) }}',
            },
            columns: [
                { data: 'DT_RowIndex', searchable: false, sortable: false },
                { data: 'tanggal' },
                { data: 'penjualan' },
                { data: 'pembelian' },
                { data: 'pengeluaran' },
                { data: 'pendapatan' }
            ],
            dom: 'Brt',
            bSort: false,
            bPaginate: false,
        });

        $('#datepicker_awal').datetimepicker({
            format: 'YYYY-MM-DD',
            icons: {
                time: 'far fa-clock',
                date: 'far fa-calendar',
                up: 'fas fa-arrow-up',
                down: 'fas fa-arrow-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right',
                today: 'fas fa-calendar-check',
                clear: 'fas fa-trash',
                close: 'fas fa-times'
            }
        });

        $('#datepicker_akhir').datetimepicker({
            format: 'YYYY-MM-DD',
            icons: {
                time: 'far fa-clock',
                date: 'far fa-calendar',
                up: 'fas fa-arrow-up',
                down: 'fas fa-arrow-down',
                previous: 'fas fa-chevron-left',
                next: 'fas fa-chevron-right',
                today: 'fas fa-calendar-check',
                clear: 'fas fa-trash',
                close: 'fas fa-times'
            }
        });

        $('#periodeForm').on('submit', function (e) {
            e.preventDefault();
            updateTable();
        });
    });

    function updatePeriode() {
        $('#modal-form').modal('show');
    }

    function updateTable() {
        const tanggalAwal = $('#tanggal_awal').val();
        const tanggalAkhir = $('#tanggal_akhir').val();

        table.ajax.url(`{{ url('laporan/data') }}/${tanggalAwal}/${tanggalAkhir}`).load();
        $('#modal-form').modal('hide');
    }

    function resetTable() {
        $('#tanggal_awal').val(defaultStartDate);
        $('#tanggal_akhir').val(defaultEndDate);
        updateTable();
    }
</script>
@endpush
