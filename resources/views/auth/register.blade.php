<!doctype html>
<html class="no-js" lang="en">


<!-- Mirrored from new.axilthemes.com/demo/template/etrade/sign-up.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 10 May 2023 14:20:53 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ABON ALFITRI || Sign Up</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('logo/logoAlfitri.png')}}">

    <!-- CSS
    ============================================ -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/font-awesome.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/flaticon/flaticon.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/slick.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/slick-theme.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/sal.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/base.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css')}}">
    <link href="{{ asset('alert/css/sweetalert2.css')}} " rel="stylesheet" />

</head>


<body>
    <div class="axil-signin-area">

        <!-- Start Header -->
        <div class="signin-header">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <a href="{{ url('register') }}" class="site-logo responsive"><img src="{{ asset('logo/logoAlfitri.png')}}"  style="width: 70px; height:auto;" alt="logo"></a>
                </div>
                <div class="col-md-6">
                    <div class="singin-header-btn">
                        <p>Already a member?</p>
                        <a href="{{ url('login') }}" class="axil-btn btn-bg-secondary sign-up-btn">Log In</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <div class="row">
            <div class="col-xl-4 col-lg-6">
                <div class="axil-signin-banner bg_image bg_image--10">
                </div>
            </div>
            <div class="col-lg-6 offset-xl-2">
                <div class="axil-signin-form-wrap">
                    <div class="axil-signin-form">
                        <h3 class="title">I'm New Here</h3>
                        <p class="b2 mb--55">Enter your detail below</p>
                        <form class="singin-form" id="data-master" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Name</label>
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
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password">
                            </div>
                            
                            <div class="form-group">
                                <button type="submit" class="axil-btn btn-bg-primary submit-btn" id="simpan-data" >Create Account</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

  <!-- Modernizer JS -->
  <script src="{{ asset('assets/js/vendor/modernizr.min.js')}}"></script>
  <!-- jQuery JS -->
  <script src="{{ asset('assets/js/vendor/jquery.js')}}"></script>
  <!-- Bootstrap JS -->
  <script src="{{ asset('assets/js/vendor/popper.min.js')}}"></script>
  <script src="{{ asset('assets/js/vendor/bootstrap.min.js')}}"></script>
  <script src="{{ asset('assets/js/vendor/slick.min.js')}}"></script>
  <script src="{{ asset('assets/js/vendor/js.cookie.js')}}"></script>
  <!-- <script src="{{ asset('assets/js/vendor/jquery.style.switcher.js')}}"></script> -->
  <script src="{{ asset('assets/js/vendor/jquery-ui.min.js')}}"></script>
  <script src="{{ asset('assets/js/vendor/jquery.ui.touch-punch.min.js')}}"></script>
  <script src="{{ asset('assets/js/vendor/jquery.countdown.min.js')}}"></script>
  <script src="{{ asset('assets/js/vendor/sal.js')}}"></script>
  <script src="{{ asset('assets/js/vendor/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{ asset('assets/js/vendor/imagesloaded.pkgd.min.js')}}"></script>
  <script src="{{ asset('assets/js/vendor/isotope.pkgd.min.js')}}"></script>
  <script src="{{ asset('assets/js/vendor/counterup.js')}}"></script>
  <script src="{{ asset('assets/js/vendor/waypoints.min.js')}}"></script>
  <script src="{{ asset('alert/js/sweetalert.js') }}"></script>

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
                    $('#simpan-data').html("Create Account");
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
                    $('#simpan-data').html(`Create Account`);
                    $('#simpan-data').removeAttr('disabled');

                }
            });
        });
    });
  </script>
  
  <script src="{{ asset('assets/js/main.js')}}"></script>
</body>
</html>