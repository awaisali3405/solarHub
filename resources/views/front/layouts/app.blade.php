<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    {{-- @if (Auth::check()) --}}

    {{-- Login --}}
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,700,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100' rel='stylesheet' type='text/css'>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/bootstrap.min.css') }}">

    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="{{ asset('assets/front/css/font-awesome.min.css') }}"> --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/front/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/responsive.css') }}">

    <!-- DataTable -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/plugins/datatable/datatable.min.css') }}">





    <!-- Toaster -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/toastr/toastr.min.css') }}">
    <script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>

    <style>
        a {
            text-decoration: none;
        }

        #chat4 .form-control {
            border-color: transparent;
        }

        #chat4 .form-control:focus {
            border-color: transparent;
            box-shadow: inset 0px 0px 0px 1px transparent;
        }

        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }
    </style>
</head>

<body>
{{-- @if (Auth::check()) --}}
<!-- ---------NAVBAR--------- -->

@include('front.common.navbar')
{{-- @endif --}}
<!-- -------NAVBAR END------ -->
@yield('content')
<!-- -------SIDEBAR END------- -->
<!-- partial -->
{{-- @if (Auth::check()) --}}
<!-- -------FOOTER START------- -->
@include('front.common.footer')






<!-- -------FOOTER END------- -->
    {{-- @endif --}}

    <!-- plugins:js -->

    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset('assets/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
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
        $('#dataTable').DataTable({});
        $(document).ready(function() {
            // toastr.success("{!! session()->get('success') !!}", 'Success')

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
    </script>
    <!-- Latest jQuery form server -->
    <script src="https://code.jquery.com/jquery.min.js"></script>

    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- jQuery sticky menu -->
    <script src="{{ asset('assets/front/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/jquery.sticky.js') }}"></script>

    <!-- jQuery easing -->
    <script src="{{ asset('assets/front/js/jquery.easing.1.3.min.js') }}"></script>

    <!-- Main Script -->
    <script src="{{ asset('assets/front/js/main.js') }}"></script>

    <!-- Slider -->
    <script type="text/javascript" src="{{ asset('assets/front/js/bxslider.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/front/js/script.slider.js') }}"></script>
    <script !src="">

        $(function(){
            $("#addClass").click(function () {
                $('#qnimate').addClass('popup-box-on');
                $('#chat-button').addClass('d-none');
            });

            $("#removeClass").click(function () {
                $('#qnimate').removeClass('popup-box-on');
                $('#chat-button').removeClass('d-none');
            });
        })
    </script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</body>

</html>
