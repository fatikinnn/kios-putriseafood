<!-- resources/views/auth/login.blade.php -->

@extends('layouts.auth')

@section('login')
<div class="preloader bg-navy flex-column justify-content-center align-items-center bg-transparant">
  <img class="animation__shake" src="{{ url($setting->path_logo) }}" alt="PutriSeafood" height="100" width="100">
</div>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <img src="{{ asset($setting->path_logo) }}" alt="{{ $setting->nama_perusahaan }} Logo" class="brand-image" style="opacity: .8; width: 100px; height: 100px;">
        <a class="h1 d-block">{{ $setting->nama_perusahaan }}</a>
      </div>
      <div class="card-body">
        @if(session('error'))
          <div class="alert alert-danger">
            {{ session('error') }}
          </div>
        @endif
        <p class="login-box-msg">Masukkan Email dan Password Anda</p>
        <form action="{{ route('login') }}" method="post" id="quickForm">
          @csrf
          <div class="input-group mb-3">
            <input type="email" name="email" id="email"
            class="form-control @error('email') is-invalid @enderror"
            placeholder="Email"
            value="{{ old('email') }}"
            required="required" 
            autofocus>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            @error('email')
            <div class="alert-block">{{ $message }}</div>
            @enderror
          </div>
          <div class="input-group mb-3">
            <input type="password"
            name="password"
            id="password"
            class="form-control @error('password') is-invalid @enderror"
            placeholder="Password"
            required="required">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            @error('password')
            <div class="alert-block">{{ $message }}</div>
            @enderror
          </div>
          <div class="col-4 float-right">
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<script src="{{ asset('lte/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

<script>
  $(function () {
    $.validator.setDefaults({
      submitHandler: function () {
        alert("Form berhasil dikirim!");
      }
    });

    $('#quickForm').validate({
      rules: {
        email: {
          required: true,
          email: true,
        },
        password: {
          required: true,
          minlength: 5
        },
        terms: {
          required: true
        },
      },
      messages: {
        email: {
          required: "Silakan masukkan alamat email",
          email: "Silakan masukkan alamat email yang valid"
        },
        password: {
          required: "Silakan masukkan kata sandi",
          minlength: "Kata sandi Anda harus terdiri dari setidaknya 5 karakter"
        },
        terms: "Silakan terima persyaratan kami"
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.input-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });
  });
</script>

<style>
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
</style>

@endsection
