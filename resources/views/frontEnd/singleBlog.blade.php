@extends('layouts.frontEnd')

@section('title')
96Legacy |  {{ $post->title }}
@endsection

@section('header') 
<header class="header text-white" style="background-image: url({{ asset('testEnd/images/96.png') }})" data-overlay="8">
    <div class="container text-center">

    <div class="row">
        <div class="col-lg-8 mx-auto">                    
            <h2>
             96Legacy Single Blog
            </h2>
        </div>
    </div>

    </div>
</header>
@endsection

@section('main-section')

<!--
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      | Blog content
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      !-->
      <div class="col-md-8 col-xl-9">
        <div class="section">
            <div class="container">

            <div class="text-center ">
                <h2>{{ $post->title }}</h2>
                <p>{{ $post->published_date }} By <a href="#">{{ $post->author->name }}</a></p>
            </div>


            <div class="my-2">
                <img class="rounded-md" src="{{ asset($post->image) }}" alt="...">
            </div>


                <p>
                    {{ $post->description }}
                </p>

                <p>
                    {{ $post->content }}
                </p>


            </div>
        </div>
      
      <!--
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      | Comments
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      !-->
      <div class=" bg-gray">
        <div class="container">
            <h3>{{ $post->comments->count() }} Comments</h3>
          
            @forelse ($post->comments as $c)
            <div class="media-list">

                <div class="media">
                  <img class="avatar avatar-sm mr-4" src="../assets/img/avatar/3.jpg" alt="...">

                  <div class="media-body">
                    <div class="small-1">
                      <strong>{{ $c->creator_name }}</strong>
                      <time class="ml-4 opacity-70 small-3" datetime="2018-07-14 20:00">{{ $c->created_at->diffForHumans() }}</time>
                    </div>
                    <p class="small-2 mb-0">
                        {{ $c->content }}
                    </p>
                  </div>

                </div>
              </div>
            @empty
                
            @endforelse
              

        </div>
      </div>
      <div class="mb-5 bg-gray">
        <div class="container">
            <form action="{{ route('blogs.comment', $post->slug) }}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                  <div class="form-group col-12 col-md-6">
                    <input class="form-control" type="text" placeholder="Name" name="name" required>
                  </div>

                  <div class="form-group col-12 col-md-6">
                    <input class="form-control" type="email" placeholder="Email" name='email' required>
                  </div>
                </div>

                <div class="form-group">
                  <textarea class="form-control" placeholder="Comment" rows="4" name="content" required></textarea>
                </div>

                <button class="btn btn-primary btn-block" type="submit">Submit your comment</button>
              </form>
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
        <a class="media text-default align-items-center mb-5" href="{{ route('frontend.music.show', ['f' => $d->slug, 'id' => $d->uuid]) }}">
            <img class="rounded w-65px mr-4" src="{{ asset($d->cover_image) }}">
            <p class="media-body small-2 lh-4 mb-0">{{ $d->title }}</p>
            <p class="media-body small-2 lh-4 mb-0">{{ $d->downloads_count }} <i class="fa fa-download"></i></p>
        </a>
        @endforeach

      



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
