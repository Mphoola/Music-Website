@extends('layouts.management')

@section('title')
96Legacy | Blog | Create
@endsection

@section('page-name')
@if (isset($post))
    Editing Post
    @else
        Creating Post
@endif
@endsection
   
@section('summernote-css')
    <link rel="stylesheet" href="{{ asset('96/css/summernote-bs4.css') }}">
@endsection

@section('main-content')
<div class="panel panel-default">
    
    <div class="panel-body">
        @if ($errors->any())
            <div class="alert alert-info">
                <ul class="list-group">
                    @foreach ($errors->all() as $error)
                        <li class="list-group-item text-danger">
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
         <form action="{{isset($post) ? route('blog-posts.update', $post->slug) : 
             route('blog-posts.store')}}" method="post" enctype="multipart/form-data">
             @csrf
             @if (isset($post))
                 @method('PUT')
             @endif
             <div class="form-group">
                 <label for="title">Title</label>
                 <input type="text" name="title" id="title" class="form-control"
                 value="{{isset($post) ? $post->title : ''}}" value="{{ old('title') }}">
             </div>
             <div class="form-group">
                 <label for="title">Description</label>
                 <textarea name="description" id="description" cols="3" rows="4" class="form-control" 
                 value="{{ old('description') }}">{!! isset($post) ? $post->description : ''!!}</textarea>
             </div>
             <div class="form-group">
                 <label for="content">Content</label>
                 <div class="mb-3">
                    <textarea class="textarea" placeholder="Place some text here" name="content" value="{{ old('content') }}"
                              style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! isset($post) ? $post->content : '' !!}</textarea>
                  </div>
             </div>
             <div class="form-group">
                 <label for="published_at">Published at</label>
                 <input type="date" name="published_at" id="published_at" 
                 value="{{isset($post) ? $post->published_at->toDateString() : ''}}" value="{{ old('published_at') }}" class="form-control">
             </div>
             
             <div class="form-group">
                 <label for="image">Post Image</label>
                 @if (isset($post))
                     <img style='width:100%;height:100%' src="{{ asset($post->image) }}" class="mb-2" alt="N/A">
                 @endif
                 <input type="file" name="image" id="image" class="form-control">
             </div>

             <div class="form-group">
                 <button class="btn btn-success btn-block" type="submit">
                     {{ isset($post) ? 'Update' : 'Create' }}
                 </button>
             </div>
         </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('96/js/summernote-bs4.min.js') }}"></script>
<script>
    $(function () {
      // Summernote
      $('.textarea').summernote()
    })
  </script>
@endsection