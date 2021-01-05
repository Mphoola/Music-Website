<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>
            @yield('title', '96Legacy')
        </title>
        <meta name="description" content="">
        <link rel="shortcut icon" href="{{ asset('testEnd/images/96.png') }}" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='stylesheet' href='{{ asset('testEnd/css/styles.min.css') }}'>
        <link rel="stylesheet" href="{{ asset('testEnd/css/page.min.css') }}">
        <link rel="stylesheet" href="{{ asset('testEnd/css/fontawesome.min.css') }}">

          <!-- toastr -->
          <link rel="stylesheet" href="{{ asset('96/css/toastr.min.css') }}">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

<!-- Navbar -->
          <nav class="navbar navbar-expand-lg " data-navbar="sticky">
            <div class="container">

              <div class="navbar-left mr-4">
                <button class="navbar-toggler" type="button">&#9776;</button>
                <a class="navbar-brand" href="/"> 96Legacy                
                </a>
              </div>

              <section class="navbar-mobile">
                <nav class="nav nav-navbar ml-auto">
                  <a class="nav-link active" href="/">Home</a>
                  <a class="nav-link" href="{{ route('frontend.music') }}">Mp3 Music</a>
                  <a class="nav-link" href="{{ route('frontend.beats') }}">Beats</a>
                  <a class="nav-link" href="{{ route('frontend.videos') }}">Videos</a>
                  <a class="nav-link" href="{{ route('shop.index') }}">Shop</a>
                  <a class="nav-link" href="{{ route('blogs.index') }}">Blog</a>
                  <a class="nav-link" href="">About</a>
                  <a class="nav-link" href="">Contact</a>
                </nav>

                <span class="navbar-divider"></span>

                <div>
                  <a class="btn btn-sm btn-round btn-primary ml-lg-4 mr-2" href="{{ route('login') }}">Sign in</a>
                  <a class="btn btn-sm btn-round btn-outline-primary" href="{{ route('register') }}">Sign up</a>
                </div>
              </section>

            </div>
          </nav><!-- /.navbar --> 
<!-- Navbar -->
<!-- /.navbar -->
          <!-- Header 
          
            </header>-- /.header -->

            @yield('header')


    <main class="main-content">
      <div class="my-0 bg-gray">
        <div class="container">
          <div class="row">

            @yield('main-section')


            @yield('sidebar')

          </div>
          
        </div>
      </div>
      

      @yield('slider')


      @yield('subscribe')
    </main>

    <footer class="footer bg-black">
      <div class="container">
        <div class="row gap-y align-items-center">

          <div class="col-md-3 text-center text-md-left">
            <a href="#"><img src="{{ asset('testEnd/images/96.png') }}" width='80px' height="100px" style="border-radius: 50%" alt="logo"></a>
          </div>

          <div class="col-md-9">
            <div class="nav nav-bold nav-uppercase justify-content-center justify-content-md-end">
              <a class="nav-link" href="/">Home</a>
              <a class="nav-link" href="{{ route('frontend.music') }}">Mp3</a>
              <a class="nav-link" href="{{ route('frontend.videos') }}">Videos</a>
              <a class="nav-link" href="{{ route('frontend.beats') }}">Beats</a>
              <a class="nav-link" href="#">Policy and Terms</a>
              <a class="nav-link" href="#">About</a>
              <a class="nav-link" href="#">Contact</a>
              <a class="nav-link" href="#">FAQ</a>
            </div>
          </div>

          <div class="col-12">
            <hr class="my-0">
          </div>

          <div class="col-md-3 text-center text-md-left">
            <small>© 2020 96Legacy. All rights reserved.</small>
          </div>

          <div class="col-md-9 text-center text-md-right">
            <div class="social social-sm social-hover-bg-brand">
              <a class="social-facebook" href="#"><i class="fab fa-facebook fa-2x"></i></a>
              <a class="social-twitter" href="#"><i class="fab fa-twitter fa-2x"></i></a>
              <a class="social-instagram" href="#"><i class="fab fa-instagram  fa-2x"></i></a>
            </div>
          </div>

        </div>
      </div>
    </footer>
             
        <script src="{{ asset('testEnd/js/page.min.js') }}"></script>
        <script src="{{ asset('testEnd/js/fontawesome.js') }}"></script>
        <script src="{{ asset('testEnd/js/script.js') }}"></script>

        <!-- toastr -->
      <script src="{{ asset('96/js/toastr.min.js') }}"></script>


      <script>
        @if (Session::has('success'))
          toastr.success('{{ session()->get('success') }}')
        @endif
        @if (Session::has('error'))
          toastr.error('{{ session()->get('error') }}')
        @endif
      </script>
    </body>
</html>