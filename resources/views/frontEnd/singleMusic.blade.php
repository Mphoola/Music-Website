@extends('layouts.frontEnd')

@section('title')
96Legacy | song Single | {{ $song->title }}
@endsection

@section('header') 
<header class="header text-white" style="background-image: url({{ asset('testEnd/images/us.png') }})" data-overlay="8">
    <div class="container text-center">

    <div class="row">
        <div class="col-lg-8 mx-auto">                    
            <h2>Home / songs / {{ $song->title }}</h2>
        </div>
    </div>

    </div>
</header>
@endsection

@section('main-section')
<div class="col-md-8 col-xl-9">
     
     <div class="row gap-y">
      <section class="section">
        <div class="container">

          <div class="row" style="margin-top: -30px">

            <div class="col-6 mx-auto col-md-5 mx-md-0">
              <img src="{{ asset($song->cover_image) }}">
            </div>

            <div class="col-6 mx-auto col-md-7 mx-md-0">
              <p class="text-light">Title: <strong>{{ $song->title }} </strong></p>
              <p class="text-light">Artist: <strong>{{ $song->artist }} </strong></p>
              <p class="text-light">Producer: <strong>{{ $song->producer }} </strong></p>
              <p class="text-light">Category: <strong>{{ $song->category->name }} </strong></p>
              <p class="text-light">Release Date: <strong>{{ $song->produced_date }} </strong></p>
              <p class="text-light">Size: <strong>{{ $size }} MB </strong></p>
              <p class="text-light">Downloads: <strong>{{ $song->downloads_count }} </strong></p>

              <div class="row gap-y align-items-center text-center bg-light rounded p-5">
                <div class="col-md-auto">
                  <p class="text-light">Click to Play</p>
                  <audio controls>
                    <source src="{{ asset($song->location) }}" type="audio/ogg">
                      Your browser does not support the audio element.
                    </audio>
                    <a class="btn btn-lg btn-success" href="{{ route('frontend.music.download', $song->uuid) }}">
                      Download Now
                    </a>
                </div>
              </div>
            </div>

          </div>

          <hr class="my-4">

          <div class="row">
            <div class="col-12 ">
              <h5><strong>{{ $song->comments->count() }}</strong> Comments and Reviews</h5>

              <div class=" mx-auto">
    
                <div class="media-list">
  
                  @forelse ($song->comments as $c)
                  <div class="media">
                    <img class="avatar avatar-sm mr-4" src="{{ asset('testEnd/images/us.png') }}" alt="...">
  
                    <div class="media-body">
                      <div class="small-1">
                        <strong>{{ $c->creator_name }}</strong>
                        <time class="ml-4 opacity-70 small-3" datetime="2018-07-14 20:00">
                          {{ $c->created_at->diffForHumans() }}
                        </time>
                      </div>
                      <p class="small-2 mb-0">
                        {{ $c->content }}
                      </p>
                    </div>
                  </div>
                  @empty
                      <h3 class="text-center lead-4">No comments yet. Be the first to review</h3>
                  @endforelse
  
                </div>
  
  
                <hr>
  
  
                <form action="{{ route('frontend.music.comment', $song->uuid) }}" method="POST">
                  @csrf
                  <div class="row">
                    <div class="form-group col-12 col-md-6">
                      <input class="form-control" type="text" placeholder="Name" required minlength="4" maxlength="25"
                      name="creator_name">
                    </div>
  
                    <div class="form-group col-12 col-md-6">
                      <input class="form-control" type="email" placeholder="Email" required name="creator_email">
                    </div>
                  </div>
  
                  <div class="form-group">
                    <textarea class="form-control" placeholder="Comment" rows="4" required maxlength="500" minlength="3"
                    name="content"></textarea>
                  </div>
  
                  <button class="btn btn-primary btn-block" type="submit">Submit your comment</button>
                </form>
  
              </div>

            </div>
          </div>

        </div>
      </section>
     </div>
</div>

@endsection

@section('sidebar')
<div class="col-md-4 col-xl-3">
    <div class="sidebar px-4 py-md-0 my-5">

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
          @foreach ($categories as $cat)
          <div class="col-6"><a href="{{ route('frontend.music.showByCategory', ['category' => $cat->slug]) }}">{{ $cat->name }}</a></div>
              
          @endforeach
      </div>

      <hr>

      <h6 class="sidebar-title">Most Downloads</h6>
      @foreach ($most_downloads as $d)
        <a class="media text-default align-items-center mb-5" href="{{ route('frontend.music.show', $d->uuid) }}">
          <img class="rounded w-65px mr-4" src="{{ asset($d->cover_image) }}">
          <p class="media-body small-2 lh-4 mb-0">{{ $d->title }}</p>
          <p class="media-body small-2 lh-4 mb-0">{{ $d->downloads_count }} <i class="fa fa-download"></i></p>
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
         <div class="rounded bg-img h-200 " style="background-image: url({{ asset('testEnd/images/us.png') }});"></div>
       picky - Unamata
       </div>
       <div class="p-2">
         <div class="rounded bg-img h-200 " style="background-image: url({{ asset('testEnd/images/us.png') }});"></div>
       picky - Unamata
       </div>
       <div class="p-2">
         <div class="rounded bg-img h-200 " style="background-image: url({{ asset('testEnd/images/us.png') }});"></div>
       picky - Unamata
       </div>
       <div class="p-2">
         <div class="rounded bg-img h-200 " style="background-image: url({{ asset('testEnd/images/us.png') }});"></div>
       picky - Unamata
       </div>
       <div class="p-2">
         <div class="rounded bg-img h-200 " style="background-image: url({{ asset('testEnd/images/us.png') }});"></div>
       picky - Unamata
       </div>
       <div class="p-2">
         <div class="rounded bg-img h-200 " style="background-image: url({{ asset('testEnd/images/us.png') }});"></div>
       picky - Unamata
       </div>
       <div class="p-2">
         <div class="rounded bg-img h-200 " style="background-image: url({{ asset('testEnd/images/us.png') }});"></div>
       picky - Unamata
       </div>
       <div class="p-2">
         <div class="rounded bg-img h-200 " style="background-image: url({{ asset('testEnd/images/us.png') }});"></div>
       picky - Unamata
       </div>

       <div class="p-2">
         <div class="rounded bg-img h-200 " style="background-image: url({{ asset('testEnd/images/us.png') }});"></div>
       picky - Unamata
       </div>

       <div class="p-2">
         <div class="rounded bg-img h-200 " style="background-image: url({{ asset('testEnd/images/us.png') }});"></div>
       picky - Unamata
       </div>

       <div class="p-2">
         <div class="rounded bg-img h-200 " style="background-image: url({{ asset('testEnd/images/us.png') }});"></div>
       picky - Unamata
       </div>
     </div>
   </section>
@endsection

@section('subscribe')
<section class="section py-5"  data-overlay="6" style="background-image: url('{{ asset('testEnd/images/us.png') }}')" >
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
