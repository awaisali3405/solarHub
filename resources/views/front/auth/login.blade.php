{{-- <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/custom/login.css') }}">
</head>
<body>
<section>
    <div class="color"></div>
    <div class="color"></div>
    <div class="color"></div>
    <div class="box">
        <div class="spuare" style="--i:0;"></div>
        <div class="spuare" style="--i:1;"></div>
        <div class="spuare" style="--i:2;"></div>
        <div class="spuare" style="--i:3;"></div>
        <div class="spuare" style="--i:4;"></div>
        <div class="container">
            <div class="form">
                <h2>Login Form</h2>
                <form method="POST" action="{{ route('admin.login') }}">
                    @csrf
                    <div class="inputBox">
                        <input id="email" placeholder="Enter E-mail" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="inputBox">
                        <input id="password" placeholder="Enter Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="inputBox">
                        <input type="submit" value="Login">
                    </div>
                    <p class="forget">Forget Password ? <a href="{{ route('admin.password.request') }}">Click Here</a></p>
                   <p class="forget">Don't Have an Account ? <a href="#">Sign up</a></p>
                </form>
            </div>
        </div>
    </div>
</section>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Solar hub</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../vendors/feather/feather.css">
    <link rel="stylesheet" href="../../vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../vendors/typicons/typicons.css">
    <link rel="stylesheet" href="../../vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="../../images/favicon.png" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                            <div class="brand-logo">
                                <h2>ERUM</h2>
                                {{-- <img src="../../images/logo.svg" alt="logo"> --}}
                            </div>
                            <h4>Hello! let's get started</h4>
                            <h6 class="fw-light">Sign in to continue.</h6>
                            {!! __(session()->get('error')) !!}
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control form-control-lg"
                                        id="exampleInputEmail1" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    {{-- <strong>asdasdsad</strong> --}}

                                    @error('email')
                                        <span class="text-danger" role="">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-lg"
                                        id="exampleInputPassword1" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    {{-- <strong>asdasdsad</strong> --}}

                                    @error('password')
                                        <span class="text-danger" role="">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        type="submit">SIGN IN</button>
                                    <a href="{{ route('register') }}"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
                                        type="submit">SIGN Up</a>
                                </div>
                                <div class="my-2 d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <label class="form-check-label text-muted">
                                            <input type="checkbox" class="form-check-input">
                                            Keep me signed in
                                        </label>
                                    </div>
                                    {{-- <a href="#" class="auth-link text-black">Forgot password?</a> --}}
                                </div>
                                {{-- <div class="mb-2">
                                    <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                                        <i class="ti-facebook me-2"></i>Connect using facebook
                                    </button>
                                </div>
                                <div class="text-center mt-4 fw-light">
                                    Don't have an account? <a href="register.html" class="text-primary">Create</a>
                                </div> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/progressbar.js/progressbar.min.js') }}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/todolist.js') }}"></script>
    <!-- plugins:js -->
    <script src="{{ asset('vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- End plugin js for this page -->

    <!-- endinject -->
    <!-- Custom js for this page-->

    <script src="{{ asset('assets/admin/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/chart/chart.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/custom/custom.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/sweetalert2/sweetalert.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatable/datatable.min.js') }}"></script>
    {{--    <script src="{{ asset('assets/admin/plugins/datatable/simple-datatables.min.js') }}"></script> --}}
    <script src="{{ asset('assets/admin/plugins/datatable/datatable_bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/admin/custom/api.js') }}"></script>

    <script type="text/javascript">
        // let table = document.querySelector('#dataTable');
        // let dataTable = new simpleDatatables.DataTable(table);
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            'baseUrl' => url('/') . '/admin/',
            'apiUrl' => url('/') . '/api/',
            'session_id' => session()->getId(),
        ]) !!};
        $(document).ready(function() {
            // $('#dataTable').DataTable({
            //     destroy: true,
            //     processing: true,
            //     select: true,
            //     paging: true,
            //     lengthChange: true,
            //     "lengthMenu": [[13, 25, 50, -1], [13, 25, 50, "All"]],
            //     searching: true,
            //     "order": [],
            //     info: false,
            //     responsive: true,
            //     autoWidth: false
            // });
            $('#dataTable').DataTable();
            toastr.options = {
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                // "rtl": isEnableRtl,
                "closeButton": true
            }
            if ("{!! session()->has('success') !!}") {
                toastr.success("{!! session()->get('success') !!}", 'Success')
            }
            if ("{!! session()->has('error') !!}") {
                toastr.error("{!! session()->get('error') !!}", 'Error')
            }
            if ("{!! session()->has('info') !!}") {
                toastr.info("{!! session()->get('info') !!}", 'Info')
            }
            if ("{!! session()->has('warning') !!}") {
                toastr.warning("{!! session()->get('warning') !!}", 'Warning')
            }
        })
        // $('#')
    </script>

</body>

</html>
