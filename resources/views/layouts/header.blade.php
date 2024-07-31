<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="dropdown user user-menu">
            <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img
                    src="{{ asset(auth()->user()->foto ?? '/lte/dist/img/user2-160x160.jpg') }}"
                    class="user-image img-circle elevation-2 img-profil"
                    alt="{{ auth()->user()->name }}'s profile picture">
                <span class="hidden-xs">{{ auth()->user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header bg-primary">
                    <img
                        src="{{ asset(auth()->user()->foto ?? '/lte/dist/img/user2-160x160.jpg') }}"
                        class="img-circle img-profil"
                        alt="{{ auth()->user()->name }}'s profile picture">
                    <p>
                        {{ auth()->user()->name }} -
                        @if(auth()->user()->level == 1)
                            Admin
                        @elseif(auth()->user()->level == 2)
                            Kasir
                        @endif
                        <br>
                        {{ auth()->user()->email }}
                    </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('user.profil') }}" class="btn btn-default btn-flat">Profil</a>
                        <a href="#" class="btn btn-default btn-flat" onclick="confirmLogout(event)">Keluar</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </li>
    </ul>
</nav>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">@yield('title')</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            @section('breadcrumb')
                            <a href="{{ url('/') }}">Home</a>
                        </li>
                        @show
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            @yield('content')
        </div>
    </section>
</div>

@push('scripts')
<script>
    function confirmLogout(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan keluar dari sesi ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, keluar!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }

    
</script>
@endpush
