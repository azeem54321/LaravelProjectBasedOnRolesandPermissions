<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Welcome To | Bootstrap Based Admin Template - Material Design</title>
    <!-- Favicon-->
    <link rel="icon" href="{{asset('favicon.ico')}}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{asset('plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{asset('plugins/morrisjs/morris.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{asset('css/themes/all-themes.css')}}" rel="stylesheet" />
    <link href="{{asset('jQuery-MultiSelect/jquery.multiselect.css')}}" rel="stylesheet" />
    <link href="{{asset('select2/dist/css/select2.min.css')}}" rel="stylesheet" />
</head>

<body class="theme-red">
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

<div class="overlay"></div>

<div class="search-bar">
    <div class="search-icon">
        <i class="material-icons">search</i>
    </div>
    <input type="text" placeholder="START TYPING...">
    <div class="close-search">
        <i class="material-icons">close</i>
    </div>
</div>

    @include('admin.layouts.header')
        <section>
            @include('admin.layouts.sidebar')
        </section>

        <!-- Main content -->
        <section class="content">
            @if (session('flash_message'))
                <span class="alert alert-success">
                {{ session('flash_message') }}
            </span>
            @endif
            @if (session('error_message'))
                <span class="alert alert-danger">
                {{ session('error_message') }}
            </span>
                @endif
            <!-- Your Page Content Here -->
            @yield('content')
        </section><!-- /.content -->


    <!-- Footer -->
    @include('admin.layouts.footer')
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap Core Js -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.js')}}"></script>

<!-- Select Plugin Js -->
{{--<script src="{{asset('plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>--}}

<!-- Slimscroll Plugin Js -->
<script src="{{asset('plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{asset('plugins/node-waves/waves.js')}}"></script>

<!-- Jquery CountTo Plugin Js -->
<script src="{{asset('plugins/jquery-countto/jquery.countTo.js')}}"></script>

<!-- Morris Plugin Js -->
<script src="{{asset('plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('plugins/morrisjs/morris.js')}}"></script>

<!-- ChartJs -->
<script src="{{asset('plugins/chartjs/Chart.bundle.js')}}"></script>

<!-- Flot Charts Plugin Js -->
{{--<script src="{{asset('plugins/flot-charts/jquery.flot.js')}}"></script>--}}
{{--<script src="{{asset('plugins/flot-charts/jquery.flot.resize.js')}}"></script>--}}
{{--<script src="{{asset('plugins/flot-charts/jquery.flot.pie.js')}}"></script>--}}
{{--<script src="{{asset('plugins/flot-charts/jquery.flot.categories.js')}}"></script>--}}
{{--<script src="{{asset('plugins/flot-charts/jquery.flot.time.js')}}"></script>--}}

<!-- Sparkline Chart Plugin Js -->
<script src="{{asset('plugins/jquery-sparkline/jquery.sparkline.js')}}"></script>

<!-- Custom Js -->
<script src="{{asset('js/admin.js')}}"></script>
{{--<script src="{{asset('js/pages/index.js')}}"></script>--}}
<script src="{{asset('select2/dist/js/select2.js')}}"></script>
<script src="{{asset('jQuery-MultiSelect/jquery.multiselect.js')}}"></script>
<!-- Demo Js -->
<script src="{{asset('js/demo.js')}}"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('ckeditor/adapters/jquery.js') }}"></script>
<script>
    $('.ckeditor').ckeditor();
</script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience -->
@yield('scripts')
</body>
</html>