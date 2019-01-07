<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebERP - @yield('title') </title>


    <link rel="stylesheet" href="{!! asset('/css/vendor.css') !!}" />
    <link rel="stylesheet" href="{!! asset('/css/app.css') !!}" />

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">

    <!-- Mainly scripts -->
    <script src="/js/jquery-3.1.1.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="/js/plugins/dataTables/datatables.min.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="/js/inspinia.js"></script>


    <script src="/js/plugins/pace/pace.min.js"></script>

    <!-- datepicker (bootstrap, nicht jquery ui -->
    <link href="/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
    <script src="/js/plugins/datapicker/bootstrap-datepicker.js"></script>

</head>
<body>

  <!-- Wrapper-->
    <div id="wrapper">

        <!-- Navigation -->
        @include('layout_app.navigation')

        <!-- Page wraper -->
        <div id="page-wrapper" class="gray-bg">

            <!-- Page wrapper -->
            @include('layout_app.topnavbar')

            <!-- Main view  -->
            @yield('content')

            <!-- Footer -->
            @include('layout_app.footer')

        </div>
        <!-- End page wrapper-->

    </div>
    <!-- End wrapper-->


@section('scripts')
@show

</body>
</html>
