<div class="text-center bg-boxed-black m-1">
    <a href="{{ route('redirect-to-vendor-site', $advert->id) }}">
        <img src="{{ asset($advert->image_path) }}" alt="{{ $advert->alt }}" class="img-fluid">
    </a>
</div>
