@extends('layouts.store')

@section('title')
    96Legacy Shop | Videos | {{ $video->full_details }}
@endsection

@section('content')
<div class="container">
    <div class="row medium-padding120">
        <div class="product-details">
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                <div class="product-details-thumb">
                    <div class="swiper-container" data-effect="fade">
                        <!-- Additional required wrapper -->
                        <div class="swiper-wrapper">
                            <!-- Slides -->
                            <div class="product-details-img-wrap swiper-slide">
                                <img src="{{ asset($video->cover_image) }}" alt="product" data-swiper-parallax="-10">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-6 col-lg-offset-1 col-md-6 col-md-offset-1 col-sm-6 col-sm-offset-1 col-xs-12 col-xs-offset-0">
                <div class="product-details-info">
                    <div class="product-details-info-price">MWK {{ $video->amount }}</div>
                    <h3 class="product-details-info-title">{{ $video->full_details }}</h3>
                    <p class="product-details-info-text">
                        Producer: {{ $video->producer }} 
                        
                    </p>
                    <p class="product-details-info-text">
                        Genre: {{ $video->category->name }} 
                        
                    </p>
                    <p class="product-details-info-text">
                        Size: {{ $size }} MB
                        
                    </p>
                    
                    <p class="product-details-info-text">
                        
                        Downloads: {{ $video->downloads->count() }}
                    </p>

                    <form action="{{ route('cart.add') }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $video->uuid }}">
                        <input type="hidden" name="model" value="App\video">
                        <div class="quantity">
                            <a href="" class="quantity-minus quantity-minus-d">-</a>
                            <input title="Qty" name="qty" class="email input-text qty text" type="text" value="1">
                            <a href="" class="quantity-plus quantity-plus-d">+</a>
                        </div>
    
                        <button type="submit" class="btn btn-medium btn--primary">
                            <span class="text">Add to Cart</span>
                            <i class="seoicon-commerce"></i>
                            <span class="semicircle"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection