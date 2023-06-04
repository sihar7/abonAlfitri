<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>ABON ALFITRI || Sign In</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
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
                <div class="col-sm-4">
                    <a href="index.html" class="site-logo"><img src="{{ asset('logo/logoAlfitri.png')}}" style="width: 70px; height:auto;" alt="logo"></a>
                </div>
                <div class="col-sm-8">
                    <div class="singin-header-btn">
                        <p>Not a member?</p>
                        <a href="{{ url('/register') }}" class="axil-btn btn-bg-secondary sign-up-btn">Sign Up Now</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header -->

        <div class="row">
            <div class="col-xl-4 col-lg-6">
                <div class="axil-signin-banner bg_image bg_image--9">
                </div>
            </div>
            <div class="col-lg-6 offset-xl-2">
                <div class="axil-signin-form-wrap">
                    <div class="axil-signin-form">
                        <h3 class="title">Log In to Abon Alfitri.</h3>
                        <p class="b2 mb--55">Enter your detail below</p>
                        <form class="singin-form" id="formLogin" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="annie@example.com">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="">
                            </div>
                            <div class="form-group d-flex align-items-center justify-content-between">
                                <button type="submit" class="axil-btn btn-bg-primary submit-btn" id="button_login">Log In</button>
                                {{-- <a href="forgot-password.html" class="forgot-btn">Forget password?</a> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JS
============================================ -->
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

    <script>
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

            function reset() {
                $("input").val('');
            }
            $("#formLogin").on('submit', function (e) {
                e.preventDefault();
                let form = $("#formLogin").serialize();
                $.ajax({
                    type: "post",
                    url: `{{ url('/postLogin') }}`,
                    data: form,
                    dataType: "json",
                    beforeSend: function () {
                        $('#button_login').html("Memproses....");
                        $('#button_login').attr('disabled', true);
                    },
                    success: function (response) {
                        $('#button_login').html("Log In");
                        $('#button_login').removeAttr('disabled');

                        if (response.message == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Berhasil Login Admin!',
                            });
                            window.location.href = `{{  url('admin') }}`;
                        } else if (response.message == 2) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: 'Berhasil Login !',
                            });
                            window.location.href = `{{  url('/') }}`;
                        } else if (response.message == 3) {
                            Toast.fire({
                                icon: 'warning',
                                title: 'User Already Login !'
                            })
                        } else if (response.message == 4) {
                            Toast.fire({
                                icon: 'error',
                                title: 'User Sudah Tidak Aktif'
                            })
                        } else if (response.message == 5) {
                            Toast.fire({
                                icon: 'warning',
                                title: 'Email Atau Password Salah !'
                            })
                        } else if (response.message == 7) {
                            window.location.href = `{{  url('admin') }}`;
                        } else if (response.message == 8) {
                            window.location.href = `{{  url('/') }}`;
                        } else {
                            Toast.fire({
                                icon: 'error',
                                title: 'Masalah Validasi !'
                            })
                        }
                    },
                    complete: function () {
                        reset();
                        $('#button_login').removeAttr('disabled');
                        $('#button_login').html("Log In");
                    }
                });
            });
        });

    </script>
    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js')}}"></script>

</body>
</html>