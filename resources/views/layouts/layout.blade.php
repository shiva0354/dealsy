<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <!-- SITE TITTLE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  {{-- getting page title from the individual page --}}
  <title>@yield('title') - Dealsy</title>
  <!-- FAVICON -->
  <link href="{!! asset('/theme/images/favicon.png') !!}" rel="shortcut icon">
  <!-- PLUGINS CSS STYLE -->
  <!-- <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet"> -->
  <!-- Bootstrap -->
  <link  href="{!! asset('theme/plugins/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet">
  <link href="{!! asset('theme/plugins/bootstrap/css/bootstrap-slider.css') !!}" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="{!! asset('theme/plugins/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet">
  <!-- Owl Carousel -->
  <link href="{!! asset('theme/plugins/slick-carousel/slick/slick.css') !!}" rel="stylesheet">
  <link href="{!! asset('theme/plugins/slick-carousel/slick/slick-theme.css') !!}" rel="stylesheet">
  <!-- Fancy Box -->
  <link href="{!! asset('theme/plugins/fancybox/jquery.fancybox.pack.css') !!}" rel="stylesheet">
  <link href="{!! asset('theme/plugins/jquery-nice-select/css/nice-select.css') !!}" rel="stylesheet">
  <!-- CUSTOM CSS -->
  <link href="{!! asset('theme/css/style.css') !!}" rel="stylesheet">
  </head>
<body class="body-wrapper">
@include('layouts.top-navigation')
<div class="container">
  @include('layouts.message')
</div>
@yield('content')
@include('layouts.footer')
  <!-- JAVASCRIPTS -->
  <script src="{!! asset('theme/plugins/jQuery/jquery.min.js') !!}"></script>
  <script src="{!! asset('theme/plugins/bootstrap/js/popper.min.js') !!}"></script>
  <script src="{!! asset('theme/plugins/bootstrap/js/bootstrap.min.js') !!}"></script>
  <script src="{!! asset('theme/plugins/bootstrap/js/bootstrap-slider.js') !!}"></script>
    <!-- tether js -->
  <script src="{!! asset('theme/plugins/tether/js/tether.min.js') !!}"></script>
  <script src="{!! asset('theme/plugins/raty/jquery.raty-fa.js') !!}"></script>
  <script src="{!! asset('theme/plugins/slick-carousel/slick/slick.min.js') !!}"></script>
  <script src="{!! asset('theme/plugins/jquery-nice-select/js/jquery.nice-select.min.js') !!}"></script>
  <script src="{!! asset('theme/plugins/fancybox/jquery.fancybox.pack.js') !!}"></script>
  <script src="{!! asset('theme/plugins/smoothscroll/SmoothScroll.min.js') !!}"></script>
  <!-- google map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU&libraries=places"></script>
  <script src="{!! asset('theme/plugins/google-map/gmap.js') !!}"></script>
  <script src="{!! asset('theme/js/script.js') !!}"></script>
  </body>
  </html>
