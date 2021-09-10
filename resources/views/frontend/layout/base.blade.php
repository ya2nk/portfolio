<!DOCTYPE html>
<html lang="en" class="no-js">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <title>Portfolio - Yudha Harsanto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="description" content="{{ $config->description }}" />
    <meta name="keywords" content="{{ $config->keywords }}" />
    <meta name="author" content="yh2bae" />
    <link rel="shortcut icon" href="{{ asset('images/yh.png') }}">


    <link rel="stylesheet" href="{{ asset('frontend/css/reset.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-grid.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/animations.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/perfect-scrollbar.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/main.css') }}" type="text/css">
    @stack('css')
  </head>

  <body>
    <!-- Animated Background -->
    <div class="lm-animated-bg" style="background-image: url({{ asset('frontend/img/main_bg.png') }});"></div>
    <!-- /Animated Background -->

    <!-- Loading animation -->
    <div class="preloader">
      <div class="preloader-animation">
        <div class="preloader-spinner">
        </div>
      </div>
    </div>
    <!-- /Loading animation -->

    <div class="page">
      <div class="page-content">

          <header id="site_header" class="header mobile-menu-hide">
            <div class="header-content">
              <div class="header-photo">
                <img src="{{ asset('/upload/user/'. $user->avatar) }}" alt="yh2bae">
              </div>
              <div class="header-titles">
                  <h2>{{ $user->name }}</h2>
              </div>
            </div>

           @include('frontend.layout.menu')

            @include('frontend.layout.social')

            <div class="header-buttons">
              <a href="#" target="_blank" class="btn btn-primary">Download CV</a>
            </div>

            <div class="copyrights">© {{ date('Y') }} All rights reserved.</div>
          </header>

          <!-- Mobile Navigation -->
          <div class="menu-toggle">
            <span></span>
            <span></span>
            <span></span>
          </div>
          <!-- End Mobile Navigation -->

          <!-- Arrows Nav -->
          <div class="lmpixels-arrows-nav">
            <div class="lmpixels-arrow-right"><i class="lnr lnr-chevron-right"></i></div>
            <div class="lmpixels-arrow-left"><i class="lnr lnr-chevron-left"></i></div>
          </div>
          <!-- End Arrows Nav -->

          @yield('content')

      </div>
          <?php
          kunjungan();
          kunjungan_detail();
          ?>
    </div>

    <script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/js/modernizr.custom.js') }}"></script>
    <script src="{{ asset('frontend/js/animating.js') }}"></script>

    <script src="{{ asset('frontend/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <script src="{{ asset('frontend/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.shuffle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/masonry.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>

    <script src="{{ asset('frontend/js/validator.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    @stack('js-internal')
    @include('sweetalert::alert')
  </body>
</html>
