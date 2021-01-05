@extends('layouts.management')

@section('title')
96Legacy | Single Blog | {{ $post->title }}
@endsection

@section('page-name', 'Blog Posts|single')
   
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('blog-posts.index') }}">Blogs</a></li>
        <li class="breadcrumb-item active">Single Details: </li>
    </ol>
@endsection

@section('main-content')
<div class="row">
    <div class="col-12">
      <h4>Title</h4>
      <p>
          {{ $post->title }}
      </p>
      <h4>Published At</h4>
      <p>
          {{ $post->published_date }}
      </p>
      <h4>Author</h4>
      <p>
          {{ $post->author->name }}
      </p>
      <h4>Description</h4>
      <p>
          {{ $post->description }}
      </p>
      <h4>Content</h4>
      <p>
          {{ $post->content }}
      </p>
      <h4>Featured Image</h4>
      <p>

          <img src="{{ asset($post->image) }}" class="img-responsive" width="1060px" height="890px">
        </p>
      <div class="float-right mb-3 mr-2 d-flex ">
         <div class="mr-2">
            @if ($post->trashed())

                <a href="{{route('blog-posts.restore', $post->slug)}}"
                    class="btn btn-info "><i class="fa fa-sync fa-spin fa-fw"></i>Restore</a>
            @else 
                <a href="{{route('blog-posts.edit', $post->slug)}}"
                    class="btn btn-info ">Edit</a>
            @endif
         </div>
          <div>
            <form action="{{route('blog-posts.destroy', $post->slug)}}" method="post">
                @csrf
                @method("DELETE")
                @if ($post->trashed())
                        <button type="submit" class="btn btn-danger">Delete</button>
                @else 
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-trash fa-fw fa-spin"></i>Trash</button>
                @endif
            </form>
          </div>
      </div>
      
    </div>
</div>
@endsection