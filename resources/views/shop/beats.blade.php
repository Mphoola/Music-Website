@extends('layouts.store')

@section('title')
    96Legacy Shop | Beats
@endsection

@section('content')
    <h2 class="text-center">All Beats</h2>
    
        <div class="row mb30">
            @forelse ($beats as $b)
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                    <div class="books-item">
                        <div class="books-item-thumb">
                            <a href="{{ route('shop.beat.show', $b->uuid) }}">
                                <img src="{{ asset($b->cover_image) }}" alt="book">
                            
                            </a>
                            <div class="overlay overlay-books"></div>
                        </div>
                        <div class="">{{ $b->downloads_count }} <i class="fa fa-download"></i></div>
                        <div class="">{{ $b->comments_count }}<i class="fa fa-comments"></i></div>
                        <div class="books-item-info">
                            <a href="{{ route('shop.beat.show', $b->uuid) }}">
                                Title:<h5 class="books-title">{{ $b->title }}</h5>
                                Producer: <h5 class="books-title text-sm-center">{{ $b->producer }}</h5>
                            </a>
                            <div class="books-price">
                                MWK {{ $b->amount }}
                            </div>
                        
                        </div>

                        <a href="{{ route('cart.add.rapid', ['id' => $b->uuid, 'model' => 'Beat']) }}" class="btn btn-small btn--dark add">
                            <span class="text">Add to Cart</span>
                            <i class="seoicon-commerce"></i>
                        </a>

                    </div>
                </div>
                @empty
                No beats uploaded yet
                @endforelse
            </div>
@endsection