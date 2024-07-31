@extends('layouts.master')

@section('title')
    Edit Profil
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Edit Profil</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <form action="{{ route('user.update_profil') }}" method="post" class="form-profil" data-toggle="validator" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-lg-2 offset-md-1 control-label">Nama</label>
                        <div class="col-lg-6">
                            <input type="text" name="name" class="form-control" id="name" required autofocus value="{{$profil->name}}">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-lg-2 offset-md-1 control-label">Email</label>
                        <div class="col-lg-6">
                            <input type="email" name="email" class="form-control" id="email" required value="{{$profil->email}}">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="foto" class="col-lg-2 offset-md-1 control-label">Profil</label>
                        <div class="col-lg-4">
                            <input type="file" name="foto" class="form-control" id="foto" onchange="preview('.tampil-foto', this.files[0])">
                            <span class="help-block with-errors"></span>
                            <br>
                            <div class="tampil-foto">
                                <img src="{{url($profil->foto  ?? '/')}}" width="200">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="old_password" class="col-lg-2 offset-md-1 control-label">Password Lama</label>
                        <div class="col-lg-4">
                            <input type="password" name="old_password" id="old_password" class="form-control" minlength="6">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-lg-2 offset-md-1 control-label">Password Baru</label>
                        <div class="col-lg-4">
                            <input type="password" name="password" id="password" class="form-control" minlength="6">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password_confirmation" class="col-lg-2 offset-md-1 control-label">Ulangi Password</label>
                        <div class="col-lg-4">
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" minlength="6">
                            <div class="invalid-feedback">
                                Password tidak sesuai.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#old_password').on('keyup', function () {
        if ($(this).val() != "") $('#password, #password_confirmation').attr('required', true);
        else $('#password, #password_confirmation').attr('required', false);
    });

    $('.form-profil').on('submit', function (e) {
        e.preventDefault();
        var form = $(this);

        // Cek kesesuaian password baru dan konfirmasi password
        if ($('#password').val() !== $('#password_confirmation').val()) {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Password baru dan konfirmasi password tidak sesuai!'
            });
            return;
        }

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: new FormData(form[0]),
            processData: false,
            contentType: false,
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    text: 'Perubahan berhasil disimpan!',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    location.reload(); // Refresh halaman setelah sukses
                });
            },
            error: function(errors) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: errors.responseJSON.message
                });
            }
        });
    });

    function preview(selector, file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.querySelector(selector).innerHTML = '<img src="' + e.target.result + '" width="200">';
        };
        reader.readAsDataURL(file);
    }
</script>
@endpush
