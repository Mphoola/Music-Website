@extends('layouts.store')

@section('title')
96Legacy Shop | Mp3 Music
@endsection

@section('content')
    <h1>all songs</h1>
    <div class="row mb30">
        @forelse ($songs as $s)
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="books-item">
                    <div class="books-item-thumb">
                        <a href="{{ route('shop.mp3-music.show', $s->uuid) }}">
                            <img src="{{ asset($s->cover_image) }}" alt="book">
                        </a>
                        
                    </div>
                    <div class="">{{ $s->downloads_count }} <i class="fa fa-download"></i></div>
                    <div class="">{{ $s->comments_count }}<i class="fa fa-comments"></i></div>
                    <div class="books-item-info">
                        <a href="{{ route('shop.mp3-music.show', $s->uuid) }}">
                        Title:<h5 class="books-title">{{ $s->title }}</h5>
                        Producer: <h5 class="books-title text-sm-center">{{ $s->producer }}</h5>
                        </a>
                        <div class="books-price">
                            MWK {{ $s->amount }}
                        </div>
                    </div>

                    <a href="{{ route('cart.add.rapid', ['id' => $s->uuid, 'model' => 'Song']) }}" class="btn btn-small btn--dark add">
                        <span class="text">Add to Cart</span>
                        <i class="seoicon-commerce"></i>
                    </a>

                </div>
            </div>
            @empty
            No songs uploaded yet
            @endforelse
        </div>
@endsection