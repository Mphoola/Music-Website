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
            <header class="header text-white" style="background-image: url({{ asset('testEnd/images/96.png') }})" data-overlay="8">
                <div class="container text-center">

                <div class="row">
                    <div class="col-lg-8 mx-auto">

                    <h1>Malawian Sounds <span class="text-primary" data-typing=" Trending, Lattest, top chats , and many more"></span></h1>
                    <p class="lead-2 mt-5">You have got the change to work and thrive with us. We are a small group of developers who wants to make a family!</p>

                    </div>
                </div>

                </div>
            </header>-- /.header -->

            @yield('header')


    <main class="main-content">
      <div class="my-0 bg-gray">
        <div class="container">
          <div class="row">

            {{-- <div class="col-md-8 col-xl-9">
             <h2 class="mt-0 mb-1 text-capitalize">Best Music</h2>
              
              <div class="row gap-y">

                <div class="col-md-4 col-xl-3 hover-shadow-1 mb-1">
                  <div class="product-3 mb-1">
                    <a class="product-media" href="item.html">
                      <span class="badge badge-pill badge-primary badge-pos-left">New</span>
                      <img src="{{ asset('testEnd/images/96.png') }}" alt="product">
                    </a>

                    <div class="product-detail">
                      <h6><a href="#">Picksy - Unamata mtima wanga wonse</a></h6>
                      <div class='d-flex justify-content-between'>
                        <div class="product-price">
                          9 <i class='fa fa-download'></i>
                        </div>
                        <div class="product-price">
                         3 <i class='fa fa-comments'></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-xl-3 hover-shadow-1 mb-1">
                  <div class="product-3 mb-1">
                    <a class="product-media" href="item.html">
                      <span class="badge badge-pill badge-primary badge-pos-left">New</span>
                      <img src="{{ asset('testEnd/images/96.png') }}" alt="product">
                    </a>

                    <div class="product-detail">
                      <h6><a href="#">Picksy - Unamata mtima wanga wonse</a></h6>
                      <div class='d-flex justify-content-between'>
                        <div class="product-price">
                          9 <i class='fa fa-download'></i>
                        </div>
                        <div class="product-price">
                         3 <i class='fa fa-comments'></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-xl-3 hover-shadow-1 mb-1">
                  <div class="product-3 mb-1">
                    <a class="product-media" href="item.html">
                      <span class="badge badge-pill badge-primary badge-pos-left">New</span>
                      <img src="{{ asset('testEnd/images/96.png') }}" alt="product">
                    </a>

                    <div class="product-detail">
                      <h6><a href="#">Picksy - Unamata mtima wanga wonse</a></h6>
                      <div class='d-flex justify-content-between'>
                        <div class="product-price">
                          9 <i class='fa fa-download'></i>
                        </div>
                        <div class="product-price">
                         3 <i class='fa fa-comments'></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-xl-3 hover-shadow-1 mb-1">
                  <div class="product-3 mb-1">
                    <a class="product-media" href="item.html">
                      <span class="badge badge-pill badge-primary badge-pos-left">New</span>
                      <img src="{{ asset('testEnd/images/96.png') }}" alt="product">
                    </a>

                    <div class="product-detail">
                      <h6><a href="#">Picksy - Unamata mtima wanga wonse</a></h6>
                      <div class='d-flex justify-content-between'>
                        <div class="product-price">
                          9 <i class='fa fa-download'></i>
                        </div>
                        <div class="product-price">
                         3 <i class='fa fa-comments'></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-xl-3 hover-shadow-1 mb-1">
                  <div class="product-3 mb-1">
                    <a class="product-media" href="item.html">
                      <span class="badge badge-pill badge-primary badge-pos-left">New</span>
                      <img src="{{ asset('testEnd/images/96.png') }}" alt="product">
                    </a>

                    <div class="product-detail">
                      <h6><a href="#">Picksy - Unamata mtima wanga wonse</a></h6>
                      <div class='d-flex justify-content-between'>
                        <div class="product-price">
                          9 <i class='fa fa-download'></i>
                        </div>
                        <div class="product-price">
                         3 <i class='fa fa-comments'></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-xl-3 hover-shadow-1 mb-1">
                  <div class="product-3 mb-1">
                    <a class="product-media" href="item.html">
                      <span class="badge badge-pill badge-primary badge-pos-left">New</span>
                      <img src="{{ asset('testEnd/images/96.png') }}" alt="product">
                    </a>

                    <div class="product-detail">
                      <h6><a href="#">Picksy - Unamata mtima wanga wonse</a></h6>
                      <div class='d-flex justify-content-between'>
                        <div class="product-price">
                          9 <i class='fa fa-download'></i>
                        </div>
                        <div class="product-price">
                         3 <i class='fa fa-comments'></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-xl-3 hover-shadow-1 mb-1">
                  <div class="product-3 mb-1">
                    <a class="product-media" href="item.html">
                      <span class="badge badge-pill badge-primary badge-pos-left">New</span>
                      <img src="{{ asset('testEnd/images/96.png') }}" alt="product">
                    </a>

                    <div class="product-detail">
                      <h6><a href="#">Picksy - Unamata mtima wanga wonse</a></h6>
                      <div class='d-flex justify-content-between'>
                        <div class="product-price">
                          9 <i class='fa fa-download'></i>
                        </div>
                        <div class="product-price">
                         3 <i class='fa fa-comments'></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-xl-3 hover-shadow-1 mb-1">
                  <div class="product-3 mb-1">
                    <a class="product-media" href="item.html">
                      <span class="badge badge-pill badge-primary badge-pos-left">New</span>
                      <img src="{{ asset('testEnd/images/96.png') }}" alt="product">
                    </a>

                    <div class="product-detail">
                      <h6><a href="#">Picksy - Unamata mtima wanga wonse</a></h6>
                      <div class='d-flex justify-content-between'>
                        <div class="product-price">
                          9 <i class='fa fa-download'></i>
                        </div>
                        <div class="product-price">
                         3 <i class='fa fa-comments'></i>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                

              </div>


              <nav class="float-right">
                <a class="btn btn-round btn-outline-success w-200 px-6" href="#section-demo">Explore More</a>
              </nav>

             <h2 class="mt-3 mb-1 text-capitalize">Lattest Beats</h2>
              
              <div class="row gap-y">

                <div class="col-md-4 col-xl-3 hover-shadow-6 mb-1 d-block">
                  <div class="product-3 mb-1">
                    <a class="product-media" href="item.html">
                      <span class="badge badge-pill badge-primary badge-pos-left">New</span>
                      <img src="{{ asset('testEnd/images/96.png') }}" alt="product">
                    </a>

                    <div class="product-detail">
                      <h6><a href="#">Apple EarPods</a></h6>
                      <div class="product-price">$160</div>
                    </div>
                  </div>
                </div>               
                
                <div class="col-md-4 col-xl-3 hover-shadow-6 mb-1 d-block">
                  <div class="product-3 mb-1">
                    <a class="product-media" href="item.html">
                      <span class="badge badge-pill badge-primary badge-pos-left">New</span>
                      <img src="{{ asset('testEnd/images/96.png') }}" alt="product">
                    </a>

                    <div class="product-detail">
                      <h6><a href="#">Apple EarPods</a></h6>
                      <div class="product-price">$160</div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-xl-3 hover-shadow-6 mb-1 d-block">
                  <div class="product-3 mb-1">
                    <a class="product-media" href="item.html">
                      <span class="badge badge-pill badge-primary badge-pos-left">New</span>
                      <img src="{{ asset('testEnd/images/96.png') }}" alt="product">
                    </a>

                    <div class="product-detail">
                      <h6><a href="#">Apple EarPods</a></h6>
                      <div class="product-price">$160</div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-xl-3 hover-shadow-6 mb-1 d-block">
                  <div class="product-3 mb-1">
                    <a class="product-media" href="item.html">
                      <span class="badge badge-pill badge-primary badge-pos-left">New</span>
                      <img src="{{ asset('testEnd/images/96.png') }}" alt="product">
                    </a>

                    <div class="product-detail">
                      <h6><a href="#">Apple EarPods</a></h6>
                      <div class="product-price">$160</div>
                    </div>
                  </div>
                </div>


              </div>


              <nav class="float-right">
                <a class="btn btn-round btn-outline-success w-200 px-6" href="#section-demo">Explore More</a>
              </nav>
             <h2 class="mt-3 mb-1 text-capitalize">Lattest Videos</h2>
              
               <div class="row gap-y">

                <div class="col-md-4 col-xl-3 hover-shadow-6 mb-1 d-block">
                  <div class="product-3 mb-1">
                    <a class="product-media" href="item.html">
                      <span class="badge badge-pill badge-primary badge-pos-left">New</span>
                      <img src="{{ asset('testEnd/images/96.png') }}" alt="product">
                    </a>

                    <div class="product-detail">
                      <h6><a href="#">Apple EarPods</a></h6>
                      <div class="product-price">$160</div>
                    </div>
                  </div>
                </div>               
                
                <div class="col-md-4 col-xl-3 hover-shadow-6 mb-1 d-block">
                  <div class="product-3 mb-1">
                    <a class="product-media" href="item.html">
                      <span class="badge badge-pill badge-primary badge-pos-left">New</span>
                      <img src="{{ asset('testEnd/images/96.png') }}" alt="product">
                    </a>

                    <div class="product-detail">
                      <h6><a href="#">Apple EarPods</a></h6>
                      <div class="product-price">$160</div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-xl-3 hover-shadow-6 mb-1 d-block">
                  <div class="product-3 mb-1">
                    <a class="product-media" href="item.html">
                      <span class="badge badge-pill badge-primary badge-pos-left">New</span>
                      <img src="{{ asset('testEnd/images/96.png') }}" alt="product">
                    </a>

                    <div class="product-detail">
                      <h6><a href="#">Apple EarPods</a></h6>
                      <div class="product-price">$160</div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4 col-xl-3 hover-shadow-6 mb-1 d-block">
                  <div class="product-3 mb-1">
                    <a class="product-media" href="item.html">
                      <span class="badge badge-pill badge-primary badge-pos-left">New</span>
                      <img src="{{ asset('testEnd/images/96.png') }}" alt="product">
                    </a>

                    <div class="product-detail">
                      <h6><a href="#">Apple EarPods</a></h6>
                      <div class="product-price">$160</div>
                    </div>
                  </div>
                </div>


              </div>


              <nav class="float-right">
                <a class="btn btn-round btn-outline-success w-200 px-6" href="#section-demo">Explore More</a>
              </nav>

        
            </div> --}}
            @yield('main-section')



            {{-- <div class="col-md-4 col-xl-3">
              <div class="sidebar px-4 py-md-0">

                <h6 class="sidebar-title">Search</h6>
                <form class="input-group" target="#" method="GET">
                  <input type="text" class="form-control" name="s" placeholder="Search">
                  <div class="input-group-addon">
                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                  </div>
                </form>

                <hr>

                <h6 class="sidebar-title">Categories</h6>
                <div class="row link-color-default fs-14 lh-24">
                  <div class="col-6"><a href="#">News</a></div>
                  <div class="col-6"><a href="#">Updates</a></div>
                  <div class="col-6"><a href="#">Design</a></div>
                  <div class="col-6"><a href="#">Marketing</a></div>
                  <div class="col-6"><a href="#">Partnership</a></div>
                  <div class="col-6"><a href="#">Product</a></div>
                  <div class="col-6"><a href="#">Hiring</a></div>
                  <div class="col-6"><a href="#">Offers</a></div>
                </div>

                <hr>

                <h6 class="sidebar-title">Most Downloads</h6>
                <a class="media text-default align-items-center mb-5" href="blog-single.html">
                  <img class="rounded w-65px mr-4" src="{{ asset('testEnd/images/96.png') }}">
                  <p class="media-body small-2 lh-4 mb-0">Thank to Maryam for joining our team</p>
                </a>

                <a class="media text-default align-items-center mb-5" href="blog-single.html">
                  <img class="rounded w-65px mr-4" src="{{ asset('testEnd/images/96.png') }}">
                  <p class="media-body small-2 lh-4 mb-0">Best practices for minimalist design</p>
                </a>

                <a class="media text-default align-items-center mb-5" href="blog-single.html">
                  <img class="rounded w-65px mr-4" src="{{ asset('testEnd/images/96.png') }}">
                  <p class="media-body small-2 lh-4 mb-0">New published books for product designers</p>
                </a>

                <a class="media text-default align-items-center mb-5" href="blog-single.html">
                  <img class="rounded w-65px mr-4" src="{{ asset('testEnd/images/96.png') }}">
                  <p class="media-body small-2 lh-4 mb-0">Top 5 brilliant content marketing strategies</p>
                </a>

                <hr>



              </div>
            </div> --}}

            @yield('sidebar')

          </div>
          
        </div>
      </div>
      
       {{-- <section class="section p-0 bg-gray">
       <h3 class='text-capitalize text-center'>Best of all time</h3>
        <div data-provide="slider" data-autoplay="true" data-slides-to-show="6" data-css-ease="linear" data-speed="12000" data-autoplay-speed="0" data-pause-on-hover="true">
          <div class="p-2">
            <div class="rounded bg-img h-200 " style="background-image: url({{ asset('testEnd/images/96.png') }});"></div>
          picky - Unamata
          </div>
          <div class="p-2">
            <div class="rounded bg-img h-200 " style="background-image: url({{ asset('testEnd/images/96.png') }});"></div>
          picky - Unamata
          </div>
          <div class="p-2">
            <div class="rounded bg-img h-200 " style="background-image: url({{ asset('testEnd/images/96.png') }});"></div>
          picky - Unamata
          </div>
          <div class="p-2">
            <div class="rounded bg-img h-200 " style="background-image: url({{ asset('testEnd/images/96.png') }});"></div>
          picky - Unamata
          </div>
          <div class="p-2">
            <div class="rounded bg-img h-200 " style="background-image: url({{ asset('testEnd/images/96.png') }});"></div>
          picky - Unamata
          </div>
          <div class="p-2">
            <div class="rounded bg-img h-200 " style="background-image: url({{ asset('testEnd/images/96.png') }});"></div>
          picky - Unamata
          </div>
          <div class="p-2">
            <div class="rounded bg-img h-200 " style="background-image: url({{ asset('testEnd/images/96.png') }});"></div>
          picky - Unamata
          </div>
          <div class="p-2">
            <div class="rounded bg-img h-200 " style="background-image: url({{ asset('testEnd/images/96.png') }});"></div>
          picky - Unamata
          </div>

          <div class="p-2">
            <div class="rounded bg-img h-200 " style="background-image: url({{ asset('testEnd/images/96.png') }});"></div>
          picky - Unamata
          </div>

          <div class="p-2">
            <div class="rounded bg-img h-200 " style="background-image: url({{ asset('testEnd/images/96.png') }});"></div>
          picky - Unamata
          </div>

          <div class="p-2">
            <div class="rounded bg-img h-200 " style="background-image: url({{ asset('testEnd/images/96.png') }});"></div>
          picky - Unamata
          </div>
        </div>
      </section> --}}

      @yield('slider')

      {{-- <section class="section py-5"  data-overlay="6" style="background-image: url({{ asset('testEnd/images/96.png') }})" >
        <div class="container">
          <div class="row">
            <div class="col-md-8 col-xl-6 mx-auto">

              <div class="section-dialog bg-transparent text-white shadow-6">
                <h4>Latest Music direct to your inbox</h4>
                <p class="text-right small pr-5">Subscribe Now</p>
                <form class="input-glass input-round" action="" method="post" target="_blank">
                  <div class="input-group">
                    <input type="text" name="EMAIL" class="form-control" placeholder="Enter Email Address">
                    <span class="input-group-append">
                      <button class="btn btn-glass btn-light" type="button">Sign up</button>
                    </span>
                  </div>
                </form>
              </div>

            </div>
          </div>
        </div>
      </section> --}}

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
    </body>
</html>