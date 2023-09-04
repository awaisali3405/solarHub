<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    {{-- <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> --}}
    <title>{{ $pageTitle }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">s
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    {{-- <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" /> --}}
    <!-- DataTable -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/plugins/datatable/datatable.min.css') }}">

    <!-- Toaster -->
    <link rel="stylesheet" href="{{ asset('assets/admin/plugins/toastr/toastr.min.css') }}">
{{--     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
{{--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
    <script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/recipe.js') }}"></script>
    <script src="{{ asset('assets/admin/js/purchase.js') }}"></script>
    <script src="{{ asset('assets/admin/js/order.js') }}"></script>
</head>


<body>
    <div class="container-scrollbar" id="app">

        <!-- ---------NAVBAR--------- -->
        @include('admin.common.navbar')
        <!-- -------NAVBAR END------ -->

        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="ti-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border me-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border me-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>


            <!-- -------SIDEBAR START------- -->
            @include('admin.common.sidebar')

            @yield('content')
            <!-- -------SIDEBAR END------- -->
        </div>
        <!-- partial -->
        <!-- -------FOOTER START------- -->
        @include('admin.common.footer')
        <!-- -------FOOTER END------- -->
    </div>

    <!-- plugins:js -->
    <script src="{{asset('js/app.js')}}" defer></script>

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
        <script src="{{ asset('assets/admin/plugins/datatable/simple-datatables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/plugins/datatable/datatable_bootstrap5.min.js') }}"></script>
    <script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.print.min.js"></script>
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
            $('#dataTable2').DataTable({

                dom: 'Bfrtip',

                buttons: [{
                        extend: 'excel',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4]
                        }
                    },
                    // {
                    //     extend: 'print',
                    //     exportOptions: {
                    //         columns: []
                    //     },
                    //     customize: function(win) {
                    //         $(win.document.body)
                    //             .css('font-size', '12px');

                    //         $(win.document.body).find('table')
                    //             .css('font-size', '12px');
                    //     }

                    // },

                ],
                paging: false,
            });
            $('#dataTable').DataTable({});
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
