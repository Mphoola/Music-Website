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
                <div class="card-header">{{ __('Uploading new Audio Song') }}</div>

                <div class="card-body">
                    <form role="form" action="{{ isset($song) ? route('songs.update', $song->id) : route('myAudioUpload') }}" 
                        method="POST" enctype="multipart/form-data">
                        @csrf
                        @if (isset($song))
                            @method('PUT')
                        @endif
                      <div class="card-body">
                        <div class="form-group">
                          <label for="title">Title</label>
                          <input type="text" class="form-control" name="title" id="title" placeholder="Enter title of the song here.." 
                          class="@error('title') is-invalid @enderror" value="{{ isset($song) ? $song->title :old('title') }}">
                          @error('title')
                                <div class="alert-danger">{{ $message }}</div>
                          @enderror
                        </div>
                        <div class="form-group">
                          <label for="artist">Artist Name(s)</label>
                          <input type="text" class="form-control" name="artist" id="artist" placeholder="Who sang the song?" 
                          class="@error('title') is-invalid @enderror" value="{{ isset($song) ? $song->artist :old('artist') }}">
                          @error('title')
                                <div class="alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                          <label for="producer">Producer Name</label>
                          <input type="text" class="form-control" name="producer" id="producer" placeholder="Who produced the song?" 
                          class="@error('producer') is-invalid @enderror" value="{{ isset($song) ? $song->producer :old('producer') }}">
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
                                <input type="date" class="form-control datetimepicker-input" value="{{ isset($song) ? $song->released_date :old('released_date') }}"
                                class="@error('released_date') is-invalid @enderror" name="released_date">
                            </div>
                            @error('released_date')
                                    <div class="alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="market">Market</label>
                                <select name="market" id="market" class="form-control" value="{{ isset($song) ? $song->market :old('market') }}">
                                    <option @if (isset($song) && $song->market == 'free')
                                        selected
                                    @endif value="free">Free</option>
                                    <option @if (isset($song) && $song->market == 'sale')
                                        selected
                                    @endif value="sale">Sale</option>
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Cost of the song</label>
                            <input type="text" class="form-control" name="amount" id="amount" value="{{ isset($song) ? $song->amount :old('amount') }}"
                            placeholder="Leave here empty if the song is for free download" min="100">
                        </div>
                       
                          <div class="form-group">
                              <label for="cover_image">Cover Image</label>
                
                              @isset ($song)
                                  <img src="{{ asset($song->cover_image) }}" alt="Cover image not found" class="img-responsive img-thumbnail rounded mb-2">
                                  <h4>Chose another image below if you want to change</h4>
                              @endisset
                
                                <div class="form-control-file">
                                    <input type="file" name="cover_image" id="cover_image" class="form-control" 
                                    class="@error('cover_image') is-invalid @enderror" value="{{ old('cover_image') }}">
                                </div>
                                @error('cover_image')
                                    <div class="alert-danger">{{ $message }}</div>
                                @enderror 
                              
                              
                          </div>
                          <div class="form-group">
                              
                              <label for="song">Song File</label>
                              @isset($song)
                                <audio controls class="bg-white">
                                    <source src="{{ asset($song->location) }}" type="audio/ogg">
                                    Your browser does not support the audio element.
                                </audio>
                                <h4>change the song file below</h4>
                              @endisset
                              <div class="form-control-file">
                                  <input type="file" name="song" id="song" class="form-control" value="{{ old('song') }}"
                                  class="@error('song') is-invalid @enderror" >
                              </div>
                              @error('song')
                                    <div class="alert-danger">{{ $message }}</div>
                                @enderror
                          </div>
                        
                      </div>
                      <!-- /.card-body -->
                
                      <div class="card-footer">
                        <button type="submit" class="btn btn-success btn-block">
                            {{ isset($song) ? "Update Song" : "Upload" }}
                        </button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
