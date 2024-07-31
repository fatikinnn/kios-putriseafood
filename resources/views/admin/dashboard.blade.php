@extends('layouts.master')

@section('title')
    Dashboard
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $kategori }}</h3>
                    <p>Total Kategori</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cube"></i>
                </div>
                <a href="{{ route('kategori.index') }}" class="small-box-footer">Lihat
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $produk }}<sup style="font-size: 20px"></sup></h3>
                    <p>Total Produk</p>
                </div>
                <div class="icon">
                    <i class="fa fa-cubes"></i>
                </div>
                <a href="{{ route('produk.index') }}" class="small-box-footer">Lihat
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $member }}</h3>
                    <p>Total Member</p>
                </div>
                <div class="icon">
                    <i class="fa fa-id-card"></i>
                </div>
                <a href="{{ route('member.index') }}" class="small-box-footer">Lihat
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $supplier }}</h3>
                    <p>Total Supplier</p>
                </div>
                <div class="icon">
                    <i class="fa fa-ship"></i>
                </div>
                <a href="{{ route('supplier.index') }}" class="small-box-footer">Lihat
                    <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Grafik Pendapatan {{ tanggal_indonesia($tanggal_awal, false) }} s/d {{ tanggal_indonesia($tanggal_akhir, false) }}</h5>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="chart">
                                <!-- Sales Chart Canvas -->
                                <canvas id="salesChart" height="180" style="height: 180px;"></canvas>
                            </div>
                            <!-- /.chart-responsive -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- ./card-body -->
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
@endsection

@push('scripts')
<script src="{{ asset('lte/plugins/chart.js/Chart.js') }}"></script>
<script>
$(function() {
    var salesChartCanvas = $('#salesChart').get(0).getContext('2d');
    var salesChart;

    function renderChart(dataTanggal, dataPendapatan) {
        var salesChartData = {
            labels: dataTanggal,
            datasets: [
                {
                    label: 'Pendapatan',
                    backgroundColor: 'rgba(60,141,188,0.9)',
                    borderColor: 'rgba(60,141,188,0.8)',
                    pointBackgroundColor: '#3b8bba',
                    pointBorderColor: 'rgba(60,141,188,1)',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(60,141,188,1)',
                    data: dataPendapatan
                }
            ]
        };

        var salesChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    display: false,
                    beginAtZero: true
                },
                y: {
                    display: false,
                    beginAtZero: true
                }
            },
            elements: {
                point: {
                    radius: 3,
                    hitRadius: 10,
                    hoverRadius: 5,
                    hoverBorderWidth: 2
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    enabled: false
                }
            }
        };

        if (salesChart) {
            salesChart.destroy();
        }

        salesChart = new Chart(salesChartCanvas, {
            type: 'line',
            data: salesChartData,
            options: salesChartOptions
        });
    }

    function fetchData() {
        $.ajax({
            url: '/api/pendapatan',
            method: 'GET',
            success: function(response) {
                var dataTanggal = response.data_tanggal;
                var dataPendapatan = response.data_pendapatan;
                renderChart(dataTanggal, dataPendapatan);
            },
            error: function(error) {
                console.error('Error fetching data:', error);
            }
        });
    }

    // Initial fetch
    fetchData();

    // Set interval to fetch data every 5 minutes (300000 milliseconds)
    setInterval(fetchData, 300000);

    // Event listener untuk merender ulang chart ketika jendela diresize
    $(window).on('resize', function() {
        if (salesChart) {
            salesChart.resize();
        }
    });

    // Event listener untuk merender ulang chart ketika sidebar di-toggle
    $(document).on('collapsed.lte.pushmenu shown.lte.pushmenu', function() {
        setTimeout(function() {
            if (salesChart) {
                salesChart.resize();
            }
        }, 300);
    });
});
</script>
@endpush
