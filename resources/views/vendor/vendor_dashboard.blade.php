<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ asset('admin/assets') }}/images/favicon-32x32.png" type="image/png" />
    <link href="{{ asset('admin/assets') }}/plugins/input-tags/css/tagsinput.css" rel="stylesheet" />
    <!--plugins-->
    <link href="{{ asset('admin/assets') }}/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link href="{{ asset('admin/assets') }}/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="{{ asset('admin/assets') }}/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="{{ asset('admin/assets') }}/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="{{ asset('admin/assets') }}/css/pace.min.css" rel="stylesheet" />
    <script src="{{ asset('admin/assets') }}/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="{{ asset('admin/assets') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('admin/assets') }}/css/app.css" rel="stylesheet">
    <link href="{{ asset('admin/assets') }}/css/icons.css" rel="stylesheet">
    <link href="{{ asset('admin/assets') }}/plugins/datatable/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets') }}/css/dark-theme.css" />
    <link rel="stylesheet" href="{{ asset('admin/assets') }}/css/semi-dark.css" />

    <link rel="stylesheet" href="{{ asset('admin/assets') }}/css/header-colors.css" />
    <title> @yield('title')</title>
    @yield('style')
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        @include('vendor.body.sidebar')
        <!--end sidebar wrapper -->
        <!--start header -->
        @include('vendor.body.header')
        <!--end header -->
        <!--start page wrapper -->
        <div class="page-wrapper">
            @yield('vendor')
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i
                class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        @include('vendor.body.footer')

    </div>
<!--end wrapper-->
<!-- Bootstrap JS -->
<script src="{{ asset('admin/assets') }}/js/bootstrap.bundle.min.js"></script>
<!--plugins-->
<script src="{{ asset('admin/assets') }}/js/jquery.min.js"></script>
<script src="{{ asset('admin/assets') }}/plugins/simplebar/js/simplebar.min.js"></script>
<script src="{{ asset('admin/assets') }}/plugins/metismenu/js/metisMenu.min.js"></script>
<script src="{{ asset('admin/assets') }}/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
<script src="{{ asset('admin/assets') }}/plugins/chartjs/js/Chart.min.js"></script>
<script src="{{ asset('admin/assets') }}/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="{{ asset('admin/assets') }}/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="{{ asset('admin/assets') }}/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
<script src="{{ asset('admin/assets') }}/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
<script src="{{ asset('admin/assets') }}/plugins/jquery-knob/excanvas.js"></script>
<script src="{{ asset('admin/assets') }}/plugins/jquery-knob/jquery.knob.js"></script>
<script src="{{ asset('admin/assets') }}/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('admin/assets') }}/plugins/input-tags/js/tagsinput.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
      } );
</script>


<script>
$(function() {
    $(".knob").knob();
});
</script>

<script src='https://cdn.tiny.cloud/1/vdqx2klew412up5bcbpwivg1th6nrh3murc6maz8bukgos4v/tinymce/5/tinymce.min.js' referrerpolicy="origin">
</script>
<script>
    tinymce.init({
      selector: '#mytextarea'
    });
</script>

<script src="{{ asset('admin/assets') }}/js/index.js"></script>
<script src="{{ asset('admin/assets') }}/js/validate.min.js"></script>
<!--app JS-->
<script src="{{ asset('admin/assets') }}/js/app.js"></script>


@yield('script')
</body>

</html>


