<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $setting->nama_perusahaan }}
            | @yield('title')Masuk</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ url($setting->path_logo) }}" type="image/*">


        <!-- Google Font: Source Sans Pro -->
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link
            rel="stylesheet"
            href="{{ asset('/lte/plugins/fontawesome-free/css/all.min.css')}}">
        <!-- icheck bootstrap -->
        <link
            rel="stylesheet"
            href="{{ asset('/lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('/lte/dist/css/adminlte.min.css')}}">
    </head>
    <body class="hold-transition login-page">
        @yield('login')
        <!-- /.login-box -->

        <!-- jQuery -->
        <script src="{{ asset('/lte/plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap 4 -->
        <script
            src="{{ asset('/lte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('/lte/dist/js/adminlte.min.js')}}"></script>
        
        <div class="footer mt-3">
            <p class="text-center">Copyright &copy; {{ $setting->nama_perusahaan }}
                {{ date('Y') }} </p>
          </div>
    </body>
</html>
