@extends('layouts.master')

@section('title', 'Data Barang')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Data Barang</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <form id="filter-form">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="date" name="start_date" id="start_date" class="form-control">
                            </div>
                            <div class="col-md-3">
                                <input type="date" name="end_date" id="end_date" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <button type="button" id="filter-button" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body table-responsive table-hover">
                    <table class="table table-stiped table-bordered table-inventory">
                        <thead class="text-center">
                            <tr>
                                <th width="5%">No</th>
                                <th>Nama</th>
                                <th>Aktivitas</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($inventory as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->produk->nama_produk }}</td>
                                    <td>{{ ucfirst($item->activity_type) }}</td>
                                    <td>{{ formatkg($item->quantity) }}</td>
                                    <td>{{ tanggal_indonesia($item->created_at) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Inisialisasi DataTable saat pertama kali halaman dimuat
    let table = $('.table-inventory').DataTable({
        responsive: true,
        autoWidth: false,
        order: [],  // Menonaktifkan sorting default
        columnDefs: [
            { orderable: false, targets: 0 } // Disable sorting on the first column (No)
        ],
        drawCallback: function(settings) {
            let api = this.api();
            api.column(0, {page: 'current'}).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }
    });

    // Fungsi untuk mengambil data dengan AJAX berdasarkan tanggal filter
    function fetchData(start_date = '', end_date = '') {
        $.ajax({
            url: "{{ route('inventory.data') }}",
            method: 'GET',
            data: { start_date: start_date, end_date: end_date },
            dataType: 'json',
            success: function(data) {
                let rows = '';
                data.forEach((item, index) => {
                    rows += `
                        <tr>
                            <td></td>
                            <td>${item.produk.nama_produk}</td>
                            <td>${item.activity_type.charAt(0).toUpperCase() + item.activity_type.slice(1)}</td>
                            <td>${formatkg(item.quantity)}</td>
                            <td>${tanggal_indonesia(item.created_at)}</td>
                        </tr>
                    `;
                });

                // Hancurkan dan inisialisasi ulang DataTable dengan data baru
                table.clear().destroy();
                $('.table-inventory tbody').html(rows);
                table = $('.table-inventory').DataTable({
                    responsive: true,
                    autoWidth: false,
                    order: [],  // Menonaktifkan sorting default
                    columnDefs: [
                        { orderable: false, targets: 0 } // Disable sorting on the first column (No)
                    ],
                    drawCallback: function(settings) {
                        let api = this.api();
                        api.column(0, {page: 'current'}).nodes().each(function(cell, i) {
                            cell.innerHTML = i + 1;
                        });
                    }
                });
            }
        });
    }

    // Tombol filter untuk mengambil data berdasarkan periode tanggal
    $('#filter-button').click(function() {
        const start_date = $('#start_date').val();
        const end_date = $('#end_date').val();
        fetchData(start_date, end_date);
    });
});

function formatkg(value) {
    return new Intl.NumberFormat('id-ID', { minimumFractionDigits: 1, maximumFractionDigits: 1 }).format(value) + ' Kg';
}

function tanggal_indonesia(date) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(date).toLocaleDateString('id-ID', options);
}
</script>
@endpush
