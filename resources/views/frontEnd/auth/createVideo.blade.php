@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('My Uploads') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="list-group">
                        <a href="{{ route('myAudios') }}">
                            <li class="list-group-item">Audios</li>
                        </a>
                        <a href="{{ route('myVideos') }}">
                            <li class="list-group-item">Videos</li>
                        </a>
                        <a href="{{ route('myBeats') }}">
                            <li class="list-group-item">Beats</li>
                        </a>
                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Uploading a Video') }}</div>

                <div class="card-body">
                                    <!-- form start -->
                    <form role="form" action="{{ isset($video) ? route('videos.update', $video->id) : route('myVideoUpload') }}" 
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($video))
                            @method('PUT')
                        @endif
                    <div class="card-body">
                        <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" placeholder="Enter title of the video here.." 
                        class="@error('title') is-invalid @enderror" value="{{ isset($video) ? $video->title :old('title') }}">
                        @error('title')
                                <div class="alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="form-group">
                        <label for="title">Artist</label>
                        <input type="text" class="form-control" name="artist" id="artist" placeholder="Enter Artist name here.." 
                        class="@error('artist') is-invalid @enderror" value="{{ isset($video) ? $video->title :old('artist') }}">
                        @error('artist')
                                <div class="alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                        
                        <div class="form-group">
                        <label for="producer">Producer Name</label>
                        <input type="text" class="form-control" name="producer" id="producer" placeholder="Who produced the video?" 
                        class="@error('producer') is-invalid @enderror" value="{{ isset($video) ? $video->producer :old('producer') }}">
                        @error('producer')
                            <div class="alert-danger">{{ $message }}</div>
                        @enderror
                        </div>
                        <div class="form-group">
                        <label for="category">Category/Genre</label>
                        
                        <select name="category_id" id="category" class="form-control" >
                            @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        </div>
                    
                        <div class="form-group">
                            <label for="released_date">Released Date</label>
                            <div class="input-group date" id="released_date">
                                <input type="date" class="form-control datetimepicker-input" value="{{ isset($video) ? $video->released_date :old('released_date') }}"
                                class="@error('released_date') is-invalid @enderror" name="released_date">
                            </div>
                            @error('released_date')
                                    <div class="alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="market">Market</label>
                                <select name="market" id="market" class="form-control" value="{{ isset($video) ? $video->market :old('market') }}">
                                    <option @if (isset($video) && $video->market == 'free')
                                        selected
                                    @endif value="free">Free</option>
                                    <option @if (isset($video) && $video->market == 'sale')
                                        selected
                                    @endif value="sale">Sale</option>
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Cost of the video</label>
                            <input type="text" class="form-control" name="amount" id="amount" value="{{ isset($video) ? $video->amount :old('amount') }}"
                            placeholder="Leave here empty if the video is for free download" min="100"
                            class="@error('amount') is-invalid @enderror">
                            @error('amount')
                                    <div class="alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="form-group">
                            <label for="cover_image">Cover Image</label>

                            @isset ($video)
                                <img src="{{ asset($video->cover_image) }}" alt="Cover image not found" class="img-responsive img-thumbnail rounded mb-2">
                                <h4>Chose another image below if you want to change</h4>
                            @endisset

                                <div class="form-control-file">
                                    <input type="file" name="cover_image" id="cover_image" class="form-control" accept=".png, .jpg, .jpeg"
                                    class="@error('cover_image') is-invalid @enderror" value="{{ old('cover_image') }}">
                                </div>
                                @error('cover_image')
                                    <div class="alert-danger">{{ $message }}</div>
                                @enderror 
                            
                            
                        </div>
                        <div class="form-group">
                            
                            <label for="video">video File</label>
                            @isset($video)
                                <audio controls class="bg-white">
                                    <source src="{{ asset($video->location) }}" type="audio/ogg">
                                    Your browser does not support the audio element.
                                </audio>
                                <h4>change the video file below</h4>
                            @endisset
                            <div class="form-control-file">
                                <input type="file" name="video" id="video" class="form-control" value="{{ old('video') }}"
                                class="@error('video') is-invalid @enderror" >
                            </div>
                            @error('video')
                                    <div class="alert-danger">{{ $message }}</div>
                                @enderror
                        </div>
                        
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-block">
                            {{ isset($video) ? "Update video" : "Upload" }}
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
