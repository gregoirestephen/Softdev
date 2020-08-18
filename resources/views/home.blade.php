
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Welcome To | Tklinik</title>

    <!-- Google Fonts -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('google.css')}}" rel="stylesheet">
    <link href="{{asset('material.css')}}" rel="stylesheet">

    <!-- Bootstrap Core Css -->
    <link href="{{asset('plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{asset('plugins/morrisjs/morris.css')}}" rel="stylesheet" />

    @yield('css-wizard')

    <!-- Custom Css -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{asset('css/themes/all-themes.css')}}" rel="stylesheet" />

    <!-- JQuery DataTable Css -->
    <link href="{{asset('css/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('css/jquery.theme.css')}}" rel="stylesheet">
    <link href="{{asset('plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css')}}" rel="stylesheet">

    <!--Toaster Css-->
    <link href="{{asset('css/toastr.css')}}" rel="stylesheet" />

</head>

<body class="theme-red">
@routes
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Please wait...</p>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->

<!-- #END# Overlay For Sidebars -->
<!-- Search Bar -->
<div class="search-bar">
    <div class="search-icon">
        <i class="material-icons">search</i>
    </div>
    <input type="text" placeholder="START TYPING...">
    <div class="close-search">
        <i class="material-icons">close</i>
    </div>
</div>
<!-- #END# Search Bar -->



@include('partial.header')
@include('partial.sidebar')
<section class="content">
    <div class="container-fluid" id="app-b">

        @yield('content')

    </div>
</section>

<!-- Vue asset -->
<script src="{{asset('js/app.js')}}"></script>

<!-- Jquery Core Js -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap Core Js -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.js')}}"></script>

<!-- Select Plugin Js -->
<script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

<!-- Slimscroll Plugin Js -->
<script src="{{asset('plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{asset('plugins/node-waves/waves.js')}}"></script>

<!-- Jquery CountTo Plugin Js -->
<script src="{{asset('plugins/jquery-countto/jquery.countTo.js')}}"></script>

<!-- Morris Plugin Js -->
<script src="{{asset('plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('plugins/morrisjs/morris.js')}}"></script>

<!-- Autosize Plugin Js -->
<script src="{{asset('plugins/autosize/autosize.js')}}"></script>

<!-- ChartJs -->
<script src="{{asset('plugins/chartjs/Chart.bundle.js')}}"></script>

<!-- JQuery Steps Plugin Js -->
<script src="{{asset('plugins/jquery-steps/jquery.steps.js')}}"></script>

<!-- Jquery Validation Plugin Css -->
<script src="{{asset('plugins/jquery-validation/jquery.validate.js')}}"></script>

<!-- Sweet Alert Plugin Js -->
<script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>

<!-- Popper Js -->
<script src="{{asset('js/popper.js')}}"></script>


<!-- Flot Charts Plugin Js -->
<script src="{{asset('plugins/flot-charts/jquery.flot.js')}}"></script>
<script src="{{asset('plugins/flot-charts/jquery.flot.resize.js')}}"></script>
<script src="{{asset('plugins/flot-charts/jquery.flot.pie.js')}}"></script>
<script src="{{asset('plugins/flot-charts/jquery.flot.categories.js')}}"></script>
<script src="{{asset('plugins/flot-charts/jquery.flot.time.js')}}"></script>

<!-- Sparkline Chart Plugin Js -->
<script src="{{asset('plugins/jquery-sparkline/jquery.sparkline.js')}}"></script>

<!--    vue Import -->
<script src="{{asset('js/vue.js')}}"></script>

<!-- Toaster Import -->
<script src="{{asset('js/toastr.js')}}"></script>

<!-- Moment Plugin Js -->
<script src="{{asset('plugins/momentjs/moment.js')}}"></script>

<!-- Jquery DataTable Plugin Js -->
<script src="{{asset('plugins/jquery-datatable/jquery.dataTables.js')}}"></script>
<script src="{{asset('plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js')}}"></script>


@yield('script-wizard')

<!-- Custom Js -->
<script src="{{asset('js/admin.js')}}"></script>
<script src="{{asset('js/pages/index.js')}}"></script>
<script src="{{asset('js/pages/tables/jquery-datatable.js')}}"></script>

<!-- Demo Js -->
<script src="{{asset('js/demo.js')}}"></script>

<script type="text/javascript">
    $('#example').DataTable();
</script>

@yield('script-header')

</body>

</html>
