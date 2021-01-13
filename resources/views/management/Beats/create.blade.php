@extends('layouts.management')

@if (isset($beat))
    @section('title')
        96Legacy | Beats | Edit | {{ $beat->title }}
    @endsection
@else
    @section('title', '96Legacy | Beats | upload')
@endif

@if (isset($beat))
    @section('page-name', 'Updating beat')
@else
    @section('page-name', 'Uploading beat')
@endif

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('beats.index') }}">All Beats</a></li>
        <li class="breadcrumb-item active">
            @if (isset($beat))
                Updating: {{ $beat->title }}
            @else
            Uploading new Beat
            @endif
        </li>
    </ol>
@endsection
    
@section('main-content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Details</h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <form role="form" action="{{ isset($beat) ? route('beats.update', $beat->id) : route('beats.upload') }}" 
        method="POST" enctype="multipart/form-data">
        @csrf
        @if (isset($beat))
            @method('PUT')
        @endif
      <div class="card-body">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" class="form-control" name="title" id="title" placeholder="Enter title of the beat here.." 
          class="@error('title') is-invalid @enderror" value="{{ isset($beat) ? $beat->title :old('title') }}">
          @error('title')
                <div class="alert-danger">{{ $message }}</div>
          @enderror
        </div>
        
        <div class="form-group">
          <label for="producer">Producer Name</label>
          <input type="text" class="form-control" name="producer" id="producer" placeholder="Who produced the beat?" 
          class="@error('producer') is-invalid @enderror" value="{{ isset($beat) ? $beat->producer :old('producer') }}">
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
                <input type="date" class="form-control datetimepicker-input" value="{{ isset($beat) ? $beat->released_date->toDateString() :old('released_date') }}"
                class="@error('released_date') is-invalid @enderror" name="released_date">
            </div>
            @error('released_date')
                    <div class="alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="market">Market</label>
                <select name="market" id="market" class="form-control" value="{{ isset($beat) ? $beat->market :old('market') }}">
                    <option @if (isset($beat) && $beat->market == 'free')
                        selected
                    @endif value="free">Free</option>
                    <option @if (isset($beat) && $beat->market == 'sale')
                        selected
                    @endif value="sale">Sale</option>
                </select>
        </div>
        <div class="form-group">
            <label for="amount">Cost of the beat</label>
            <input type="text" class="form-control" name="amount" id="amount" value="{{ isset($beat) ? $beat->amount :old('amount') }}"
            placeholder="Leave here empty if the beat is for free download" min="100"
            class="@error('amount') is-invalid @enderror">
            @error('amount')
                    <div class="alert-danger">{{ $message }}</div>
            @enderror
        </div>
       
          <div class="form-group">
              <label for="cover_image">Cover Image</label>

              @isset ($beat)
                  <img src="{{ asset($beat->cover_image) }}" alt="Cover image not found" class="img-responsive img-thumbnail rounded mb-2">
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
              
              <label for="beat">beat File</label>
              @isset($beat)
                <audio controls class="bg-white">
                    <source src="{{ asset($beat->location) }}" type="audio/ogg">
                    Your browser does not support the audio element.
                </audio>
                <h4>change the beat file below</h4>
              @endisset
              <div class="form-control-file">
                  <input type="file" name="beat" id="beat" class="form-control" value="{{ old('beat') }}"
                  class="@error('beat') is-invalid @enderror" >
              </div>
              @error('beat')
                    <div class="alert-danger">{{ $message }}</div>
                @enderror
          </div>
        
      </div>
      <!-- /.card-body -->

      <div class="card-footer">
        <button type="submit" class="btn btn-success btn-block">
            {{ isset($beat) ? "Update beat" : "Upload" }}
        </button>
      </div>
    </form>
  </div>
@endsection