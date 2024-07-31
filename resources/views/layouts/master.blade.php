<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $setting->nama_perusahaan }} | @yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ url($setting->path_logo) }}" type="image/*">

    <!-- External CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('sa2/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('sa2/sweetalert2.min.css') }}">

    <!-- Inline Styles -->
    <style>
        .modal.custom-fade .modal-dialog {
            transition: transform 0.3s ease-out, opacity 0.3s ease-out;
            transform: translateY(-100px);
            opacity: 0;
        }
        .modal.custom-fade.show .modal-dialog {
            transform: translateY(0);
            opacity: 1;
        }
        .nav-sidebar .nav-link.active {
            border-left: 3px solid #007bff;
            background-color: #343a40;
            color: white;
        }
        .user-panel {
            display: flex;
            align-items: center;
        }
        .user-panel .image {
            margin-right: 10px;
        }
        .img-profil {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        .btn {
            transition: all 0.3s ease;
        }
        .btn:hover {
            transform: scale(1.05);
        }
        .btn:focus {
            transform: scale(1.05);
            outline: none;
        }
        .swal2-cancel,
        .swal2-confirm {
            transition: all 0.3s ease;
        }
        .swal2-cancel:hover,
        .swal2-confirm:hover {
            transform: scale(1.05);
        }
        .swal2-cancel:focus,
        .swal2-confirm:focus {
            transform: scale(1.05);
            outline: none;
        }
    </style>

    @stack('css')
</head>
<body class="hold-transition sidebar-mini layout-navbar-fixed layout-fixed">
    <div class="wrapper">
        <div class="preloader bg-navy flex-column justify-content-center align-items-center bg-transparent">
            <img class="animation__shake" src="{{ url($setting->path_logo) }}" alt="PutriSeafood" height="100" width="100">
        </div>

        @includeIf('layouts.header')
        @includeIf('layouts.sidebar')

        <!-- Content Wrapper -->
        <div class="content">
            <section class="content"></section>
        </div>

        @includeIf('layouts.footer')
    </div>

    <!-- External Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('sa2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('lte/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('lte/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
    <script src="{{ asset('lte/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
    <script src="{{ asset('lte/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>AOS.init();</script>
    <script src="{{ asset('lte/dist/js/pages/dashboard2.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/autoNumeric/4.5.4/autoNumeric.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="{{ asset('lte/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

    <script>
        function preview(selector, temporaryFile, width = 200) {
            $(selector).empty();
            $(selector).append(
                `<img src="${window.URL.createObjectURL(temporaryFile)}" width="${width}">`
            );
        }

        $(document).ready(function () {
            // Initialize custom file input
            bsCustomFileInput.init();
        });
    </script>

    @stack('scripts')
</body>
</html>
