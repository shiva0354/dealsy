<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- SITE TITTLE -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('seo')
    <!-- FAVICON -->
    <link href="{!! asset('images/dealsy-icon.png') !!}" rel="shortcut icon">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- PLUGINS CSS STYLE -->
    <!-- <link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet"> -->
    <!-- Bootstrap -->
    {{-- <link  href="{!! asset('plugins/bootstrap/css/bootstrap.min.css') !!}" rel="stylesheet"> --}}
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{-- <link href="{!! asset('plugins/bootstrap/css/bootstrap-slider.css') !!}" rel="stylesheet"> --}}
    <link href="{!! asset('plugins/slick-carousel/slick/slick.css') !!}" rel="stylesheet">
    <link href="{!! asset('plugins/slick-carousel/slick/slick-theme.css') !!}" rel="stylesheet">
    <!-- Fancy Box -->
    {{-- <link href="{!! asset('plugins/fancybox/jquery.fancybox.pack.css') !!}" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <!-- CUSTOM CSS -->
    <link href="{!! asset('css/style.css') !!}" rel="stylesheet">
</head>

<body class="body-wrapper">

    @include('layouts.top-navigation')
    <div class="container">
        @include('layouts.message')
    </div>
    @yield('content')

    @include('layouts.footer')
    <!-- JAVASCRIPTS -->
    {{-- <script src="{!! asset('plugins/jQuery/jquery.min.js') !!}"></script> --}}
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" crossorigin="anonymous"></script>
    {{-- <script src="{!! asset('plugins/bootstrap/js/popper.min.js') !!}"></script> --}}
    {{-- <script src="{!! asset('plugins/bootstrap/js/bootstrap.min.js') !!}"></script> --}}
    {{-- <script src="{!! asset('plugins/bootstrap/js/bootstrap-slider.js') !!}"></script> --}}
    <!-- tether js -->
    {{-- <script src="{!! asset('plugins/tether/js/tether.min.js') !!}"></script> --}}
    {{-- <script src="{!! asset('plugins/raty/jquery.raty-fa.js') !!}"></script> --}}
    <script src="{!! asset('plugins/slick-carousel/slick/slick.min.js') !!}"></script>
    {{-- <script src="{!! asset('plugins/jquery-nice-select/js/jquery.nice-select.min.js') !!}"></script> --}}
    {{-- <script src="{!! asset('plugins/fancybox/jquery.fancybox.pack.js') !!}"></script> --}}
    {{-- <script src="{!! asset('plugins/smoothscroll/SmoothScroll.min.js') !!}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script>
        $(document).on('ready', function() {
            function switcher() {
                let locale = $('#language-switcher').val();
                $.ajax({
                    url: "/set/locale/-XXX-".replace('-XXX-', locale),
                    type: "get",
                    success: function(response) {
                        if (response == 'success') {
                            location.reload();
                            console.log('success');
                        } else {
                            alert(response);
                        }
                    }
                });
            }
        });
    </script>
    @yield('js-script')
</body>

</html>
