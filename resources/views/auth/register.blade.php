@extends('layouts.landingPage.master')
@push('title')
Abon Alfitri | REGISTER
@endpush

@push('customcss')

@endpush

@section('content-main')
<div class="axil-breadcrumb-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-8">
                <div class="inner">
                    <ul class="axil-breadcrumb">
                        <li class="axil-breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="separator"></li>
                        <li class="axil-breadcrumb-item active" aria-current="page">Register</li>
                    </ul>
                    <h1 class="title">Register</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="service-area">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-6">
                <div class="axil-signin-banner">
                </div>
            </div>
            <div class="col-lg-6 offset-xl-2">
                <div class="axil-signin-form-wrap">
                    <div class="axil-signin-form">
                        <h3 class="title">Saya baru disini</h3>
                        <p class="b2 mb--55">Masukkan detail Anda di bawah ini</p>
                        <form class="singin-form" id="data-master" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Password</label>
                                <input type="password" class="form-control" name="confirm_password">
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="axil-btn btn-bg-primary submit-btn" id="simpan-data" >Buat Akun</button>
                                <a href="{{ url('/login') }}" class="forgot-btn">Sudah punya akun ?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
  
@push('customjs')
<script type="text/javascript">
    function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    function harusHuruf(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if ((charCode < 65 || charCode > 90) && (charCode < 97 || charCode > 122) && charCode > 32)
            return false;
        return true;
    }

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }); 

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 10000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        $('#data-master').on('submit', function (e) {
            e.preventDefault();
            $('#simpan-data').html("Registrasi...");
            $('#simpan-data').attr('disabled', true);
            let data = $("#data-master").serialize();
            let datax = new FormData(this);
            // console.log(data[0].jenis_menu);
            console.log(data);
            $.ajax({
                type: "post",
                url: "{{url('/postRegister')}}",
                data: datax,
                dataType: "json",
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    $("#jenis_menuHelp").html("");
                    $('#simpan-data').html("Buat Akun");
                    $('#simpan-data').removeAttr('disabled');
                    if (response.status == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Berhasil Registrasi Akun, Silahkan Login !',
                        });
                        
                        window.location.href=`{{ url('login') }}`;
                    } else if (response.status == 2) {
                        Swal.fire({
                            icon: 'warning',
                            text: 'Email Telah Digunakan !',
                        });
                    } else if (response.status == 3) {
                        Toast.fire({
                            icon: 'warning',
                            title: 'Password Tidak Sama'
                        });
                    }
                },
                error: function (e) {
                    Toast.fire({
                        icon: 'error',
                        title: 'Gagal Registrasi Akun !'
                    });
                    $('#simpan-data').html(`Buat Akun`);
                    $('#simpan-data').removeAttr('disabled');

                }
            });
        });
    });
  </script>
<script type="text/javascript">
    function disableSelection(e) {
        if (typeof e.onselectstart != "undefined") e.onselectstart = function () {
            return false
        };
        else if (typeof e.style.MozUserSelect != "undefined") e.style.MozUserSelect = "none";
        else e.onmousedown = function () {
            return false
        };
        e.style.cursor = "default"
    }
    window.onload = function () {
        disableSelection(document.body)
    }

</script>
<script type="text/javascript">
    window.addEventListener("keydown", function (e) {
        if (e.ctrlKey && (e.which == 65 || e.which == 66 || e.which == 67 || e.which == 73 || e.which ==
                80 || e.which == 83 || e.which == 85 || e.which == 86)) {
            e.preventDefault()
        }
    });
    document.keypress = function (e) {
        if (e.ctrlKey && (e.which == 65 || e.which == 66 || e.which == 67 || e.which == 73 || e.which == 80 || e
                .which == 83 || e.which == 85 || e.which == 86)) {}
        return false
    }

</script>
<script type="text/javascript">
    document.onkeydown = function (e) {
        e = e || window.event;
        if (e.keyCode == 123 || e.keyCode == 18) {
            return false
        }
    }

</script>
@endpush
