@extends('layouts.frontEnd')

@section('title')
96Legacy | Blogs
@endsection

@section('header') 
<header class="header text-white" style="background-image: url({{ asset('testEnd/images/96.png') }})" data-overlay="8">
    <div class="container text-center">

    <div class="row">
        <div class="col-lg-8 mx-auto">                    
            <h2>
             96Legacy Blog
            </h2>
        </div>
    </div>

    </div>
</header>
@endsection

@section('main-section')
<div class="col-md-8 col-xl-9">
  <h2 class="mt-3 mb-2 text-capitalize">
    Blog Posts
  </h2>
  <div class="row gap-y">

    @forelse ($posts as $post)
      <div class="col-md-6">
        <div class="card border hover-shadow-6 mb-6 d-block">
          <a href="{{ route('blogs.show', $post->slug) }}">
          <img class="card-img-top" style="width:395px; height:420px"
              src="{{ asset($post->image) }}" alt="Card image cap">
          </a>
        <div class="p-6 text-center">
          <h5 class="mb-0">
            <a class="text-dark" href="{{ route('blogs.show', $post->slug) }}">
                {{ $post->title }}
            </a>
        </h5>
          <div class="d-flex justify-content-between small-5 text-lighter text-uppercase ls-2 fw-400">
            <div>
              {{ $post->views }} views
            </div>
            <div>
              {{ $post->published_date }}
            </div>
          </div>
          
        </div>
        </div>
      </div>

    @empty
        <h3 class="text-center">No Post yet</h3>
    @endforelse
    <div class="float-right m-5 p4">
      {{ $posts->links() }}
    </div>
  </div>
</div>


@endsection

@section('sidebar')
<div class="col-md-4 col-xl-3">
    <div class="sidebar px-4 py-md-0 my-5">

      <h6 class="sidebar-title">Search</h6>
      @include('partials.search')

      <hr>

      <h6 class="sidebar-title">Popular Posts</h6>
      @foreach ($popular_posts as $p)
        <a class="media text-default align-items-center mb-5" href="{{ route('blogs.show', $p->slug) }}">
            <img class="rounded w-65px mr-4" src="{{ asset($p->image) }}">
            <p class="media-body small-2 lh-4 mb-0">{{ $p->title }}</p>
            <p class="media-body small-2 lh-4 mb-0">{{ $p->views }} <i class="fa fa-download"></i></p>
        </a>
        @endforeach

      <hr>

      <h6 class="sidebar-title">Most Downloaded Music</h6>
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
