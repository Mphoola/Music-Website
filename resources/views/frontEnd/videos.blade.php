@extends('layouts.frontEnd')

@section('title')
96Legacy | Music Videos
@endsection

@section('header') 
<header class="header text-white" style="background-image: url({{ asset('testEnd/images/96.png') }})" data-overlay="8">
    <div class="container text-center">

    <div class="row">
        <div class="col-lg-8 mx-auto">                    
            <h2>
              @if (isset($category))
                Best of {{ $category }} Videos
              @else
              Malawian Top Videos
              @endif
            </h2>
        </div>
    </div>

    </div>
</header>
@endsection

@section('main-section')
<div class="col-md-8 col-xl-9">
    <h2 class="mt-3 mb-2 text-capitalize">
      @if (isset($category))
       Best of {{ $category }} Videos
    @else
     All Videos
    @endif
    </h2>
     
     <div class="row gap-y">

       @if (isset($vids))
        @foreach ($vids as $v)
        <div class="col-md-4 col-xl-3 hover-shadow-1 mb-1">
          <div class="product-3 mb-1">
            <a class="product-media" href="{{ route('frontend.videos.show', ['f' => $v->slug, 'id' => $v->uuid]) }}">
              <span class="badge badge-pill badge-primary badge-pos-left">New</span>
              <img src="{{ asset($v->cover_image) }}" alt="no cover image">
            </a>

            <div class="product-detail">
              <h6><a href="{{ route('frontend.videos.show', ['f' => $v->slug, 'id' => $v->uuid]) }}">{{ $v->full_details }}</a></h6>
              <div class='d-flex justify-content-between'>
                <div class="product-price">
                  {{ $v->downloads_count }} <i class='fa fa-download'></i>
                </div>
                <div class="product-price">
                {{ $v->comments_count }} <i class='fa fa-comments'></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach 
        {{isset($vids) ? $vids->links() : '' }}
       @else
       @foreach ($videos as $v)
       <div class="col-md-4 col-xl-3 hover-shadow-1 mb-1">
        <div class="product-3 mb-1">
          <a class="product-media" href="{{ route('frontend.videos.show', ['f' => $v->slug, 'id' => $v->uuid]) }}">
            <span class="badge badge-pill badge-primary badge-pos-left">New</span>
            <img src="{{ asset($v->cover_image) }}" alt="no cover image">
          </a>

          <div class="product-detail">
            <h6><a href="{{ route('frontend.videos.show', ['f' => $v->slug, 'id' => $v->uuid]) }}">{{ $v->full_details }}</a></h6>
            <div class='d-flex justify-content-between'>
              <div class="product-price">
                {{ $v->downloads_count }} <i class='fa fa-download'></i>
              </div>
              <div class="product-price">
               {{ $v->comments_count }} <i class='fa fa-comments'></i>
              </div>
            </div>
          </div>
        </div>
      </div>
       @endforeach  
       {{ isset($videos) ? $videos->links() : '' }}
       @endif

     </div>
</div>

@endsection

@section('sidebar')
<div class="col-md-4 col-xl-3">
    <div class="sidebar px-4 py-md-0 my-5">

      <h6 class="sidebar-title">Search</h6>
      @include('partials.search')

      <hr>

      <h6 class="sidebar-title">Categories</h6>
      <div class="row link-color-default fs-14 lh-24">
          @foreach ($categories as $cat)
          <div class="col-6"><a href="{{ route('frontend.videos.showByCategory', $cat->slug) }}">{{ $cat->name }}</a></div>
              
          @endforeach
      </div>

      <hr>

      <h6 class="sidebar-title">Most Downloads</h6>
      @foreach ($most_downloads as $d)
        <a class="media text-default align-items-center mb-5" href="{{ route('frontend.videos.show', ['f' => $d->slug, 'id' => $d->uuid]) }}">
          <img class="rounded w-65px mr-4" src="{{ asset($d->cover_image) }}">
          <p class="media-body small-2 lh-4 mb-0">{{ $d->downloads_count }} <i class="fa fa-download"></i></p>
          <p class="media-body small-2 lh-4 mb-0">{{ $d->title }}</p>
        </a>
      @endforeach

      <hr>



    </div>
  </div>
@endsection

@section('slider')
<section class="section p-0 bg-gray">
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
   </section>
@endsection

@section('subscribe')
<section class="section py-5"  data-overlay="6" style="background-image: url('{{ asset('testEnd/images/96.png') }}')" >
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
  </section>
@endsection
