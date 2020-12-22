@extends('layouts.store')

@section('title')
96Legacy Shop | Videos
@endsection

@section('content')
<h1>all videos</h1>
<div class="row mb30">
    @forelse ($videos as $v)
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <div class="books-item">
                <div class="books-item-thumb">
                    <a href="{{ route('shop.video.show', $v->uuid) }}">
                    <img src="{{ asset($v->cover_image) }}" alt="book">
                    </a>
                    
                </div>
                <div class="">{{ $v->downloads_count }} <i class="fa fa-download"></i></div>
                <div class="">{{ $v->comments_count }}<i class="fa fa-comments"></i></div>
                <div class="books-item-info">
                    <a href="{{ route('shop.video.show', $v->uuid) }}">
                    Title:<h5 class="books-title">{{ $v->title }}</h5>
                    Producer: <h5 class="books-title text-sm-center">{{ $v->producer }}</h5>
                    </a>
                    <div class="books-price">
                        MWK {{ $v->amount }}
                    </div>
                </div>

                <a href="{{ route('cart.add.rapid', ['id' => $v->uuid, 'model' => 'Video']) }}" class="btn btn-small btn--dark add">
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