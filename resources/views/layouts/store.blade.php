<!DOCTYPE html>
<html lang="en">
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>
        @yield('title', '96Legacy Shop')
    </title>

  @if (Route::currentRouteName() == 'cart.checkout')
      <link rel="stylesheet" href="{{ asset('css/za.css') }}">
      <script src="{{ asset('js/za.js') }}"></script>
  @endif

  @yield('scripts')

    <link rel="stylesheet" type="text/css" href="{{ asset('store/css/fonts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('store/css/crumina-fonts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('store/css/normalize.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('store/css/grid.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('store/css/styles.css') }}">

    <link rel="stylesheet" href="{{ asset('96/css/fontawesome.css') }}">
    <link rel="shortcut icon" href="{{ asset('testEnd/images/us.png') }}" type="image/x-icon">

        <!-- toastr -->
        <link rel="stylesheet" href="{{ asset('96/css/toastr.min.css') }}">
    <!--Plugins styles-->

    <link rel="stylesheet" type="text/css" href="{{ asset('store/css/jquery.mCustomScrollbar.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('store/css/swiper.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('store/css/primary-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('store/css/magnific-popup.css') }}">

    <!--Styles for RTL-->

    <!--<link rel="stylesheet" type="text/css" href="css/rtl.css">-->

    <!--External fonts-->

    <link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>

</head>


<body class=" ">

<header class="header" id="site-header">

    <div class="container">

        <div class="header-content-wrapper">

            <div class="nav-add">

                  <div>

                    <a href="/" style="margin: 5px; padding: 7px; background: pink">Go to Free Download</a>
                </div>
                  <div>
                    <a href="{{ route('shop.beats') }}" style="margin: 5px; padding: 7px; background: pink">Beats</a>

                </div>
                  <div >
                    <a href="{{ route('shop.mp3-music') }}" style="margin: 5px; padding: 7px; background: pink">Mp3 Music</a>
                </div>
                  <div  >

                    <a href="{{ route('shop.videos') }}" style="margin: 5px; padding: 7px; background: pink">Videos</a>
                </div>

                <li class="cart">

                    <a  class="js-cart-animate">
                        <i class="fa fa-cart-plus fa-2x"></i>
                        <span class="cart-count">{{ Cart::getContent()->count() }}</span>
                    </a>

                    <div class="cart-popup-wrap">
                        <div class="popup-cart">
                            <h4 class="title-cart align-center">MWK {{ Cart::getTotal() }}.00</h4>

                            <a href="{{ route('cart.items') }}">
                                <div class="btn btn-small btn--dark">
                                    <span class="text">view Cart</span>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

</header>


<div class="content-wrapper">

    <div class="container">
        <div class="row pt120">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="heading align-center mb60">
                    <h4 class="h1 heading-title">96Legacy Store</h4>
                    <p class="heading-text">Buy beats, mp3 Music, Music Videos
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- End Books products grid -->

    <div class="container">
        <div class="row pt120">
            <div class="books-grid">

            {{-- <div class="row mb30">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="books-item">
                        <div class="books-item-thumb">
                            <img src="img/book6.png" alt="book">
                            <div class="new">New</div>
                            <div class="sale">Sale</div>
                            <div class="overlay overlay-books"></div>
                        </div>

                        <div class="books-item-info">
                            <h5 class="books-title">Presenting Data</h5>

                            <div class="books-price">$63.00</div>
                        </div>

                        <a href="19_cart.html" class="btn btn-small btn--dark add">
                            <span class="text">Add to Cart</span>
                            <i class="seoicon-commerce"></i>
                        </a>

                    </div>
                </div>
            </div> --}}

            @yield('content')

            {{-- <div class="row pb120">

                <div class="col-lg-12">

                    <nav class="navigation align-center">

                        <a href="#" class="page-numbers bg-border-color current"><span>1</span></a>
                        <a href="#" class="page-numbers bg-border-color"><span>2</span></a>
                        <a href="#" class="page-numbers bg-border-color"><span>3</span></a>
                        <a href="#" class="page-numbers bg-border-color"><span>4</span></a>
                        <a href="#" class="page-numbers bg-border-color"><span>5</span></a>

                        <svg class="btn-prev">
                            <use xlink:href="#arrow-left"></use>
                        </svg>
                        <svg class="btn-next">
                            <use xlink:href="#arrow-right"></use>
                        </svg>

                    </nav>

                </div>

            </div> --}}
        </div>
        </div>
    </div>
</div>

<!-- Footer -->

<footer class="footer">
    <div class="sub-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    96Legacy
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="{{ asset('testEnd/js/fontawesome.js') }}"></script>

<script src="{{ asset('store/js/jquery-2.1.4.min.js')}}"></script>
<script src="{{ asset('store/js/crum-mega-menu.js')}}"></script>
<script src="{{ asset('store/js/swiper.jquery.min.js')}}"></script>
<script src="{{ asset('store/js/theme-plugins.js')}}"></script>
<script src="{{ asset('store/js/main.js')}}"></script>
<script src="{{ asset('store/js/form-actions.js')}}"></script>

<script src="{{ asset('store/js/velocity.min.js')}}"></script>
<script src="{{ asset('store/js/ScrollMagic.min.js')}}"></script>
<script src="{{ asset('store/js/animation.velocity.min.js')}}"></script>

<!-- ...end JS Script -->

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

<!-- Mirrored from theme.crumina.net/html-seosight/16_shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 27 Nov 2016 13:03:04 GMT -->
</html>
