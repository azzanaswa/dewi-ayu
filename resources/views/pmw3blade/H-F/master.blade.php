<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <!-- Site Metas -->
    <title>PMW UNESA</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="#" type="image/x-icon" />
    <link rel="apple-touch-icon" href="#" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('projek/css/bootstrap.min.css')}}" />
    <!-- Pogo Slider CSS -->
    <link rel="stylesheet" href="{{asset('projek/css/pogo-slider.min.css')}}" />
    <!-- Site CSS -->
    <link rel="stylesheet" href="{{asset('projek/css/style.css')}}" />
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('projek/css/responsive.css')}}" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{asset('projek/css/custom.css')}}" />

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="inner_page" data-spy="scroll" data-target="#navbar-wd" data-offset="98">

    <!-- LOADER -->
    <div id="preloader">
        <div class="loader">
            <img src="{{asset('projek/images/loader.gif')}}" alt="#" />
        </div>
    </div>
    <!-- end loader -->
    <!-- END LOADER -->
    @include('pmw3blade.H-F.header')
    @yield('content') 
    @include('pmw3blade.H-F.footer')
<a href="#" id="scroll-to-top" class="hvr-radial-out"><i class="fa fa-angle-up"></i></a>

    <!-- ALL JS FILES -->
    <script src="{{asset('projek/js/jquery.min.js')}}"></script>
    <script src="{{asset('projek/js/popper.min.js')}}"></script>
    <script src="{{asset('projek/js/bootstrap.min.js')}}"></script>
    <!-- ALL PLUGINS -->
    <script src="{{asset('projek/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('projek/js/jquery.pogo-slider.min.js')}}"></script>
    <script src="{{asset('projek/js/slider-index.js')}}"></script>
    <script src="{{asset('projek/js/smoothscroll.js')}}"></script>
    <script src="{{asset('projek/js/form-validator.min.js')}}"></script>
    <script src="{{asset('projek/js/contact-form-script.js')}}"></script>
    <script src="{{asset('projek/js/isotope.min.js')}}"></script>
    <script src="{{asset('projek/js/images-loded.min.js')}}"></script>
    <script src="{{asset('projek/js/custom.js')}}"></script>
    
</body>

</html>