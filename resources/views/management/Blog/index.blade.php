@extends('layouts.management')

@section('title', '96Legacy | Blogs')

@section('page-name')
@if (request()->path() == 'management/blog-posts/trashed')
    Trashed Posts
@else 
    Latest Posts
@endif
@endsection
    
@section('main-content')
<div class="row">
    <div class="col-12">
        @if (request()->path() == 'management/blog-posts/trashed')
            <a href="{{route('blog-posts.index')}}" class="btn btn-primary btn-sm float-right mb-2">
                View Published Posts</a>
        @else 
            <a href="{{route('blog-posts.trashed')}}" class="btn btn-secondary btn-sm float-right mb-2">
                View Trashed Posts</a>
            
            <a href="{{route('blog-posts.create')}}" class="btn btn-success btn-sm float-right mb-2 mr-2">
                <i class="fas fa-plus fa-fw"></i>Add Post</a>
        @endif
        
        
   <div class="panel panel-default" style="margin-top:10px">
       
       <div class="panel-body">
           @if ($posts->count() == 0)
               <h3 class="text-center">No Posts yet</h3>
            @else
                <table class="table table-striped">
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>More</th>
                        
                    </tr>
                    @foreach ($posts as $post)
                        <tr>
                        
                            <td>
                                <img style='width:110px;height:120px' src="{{ asset($post->image) }}" alt="N/A">
                            </td>
                            <td style="">{{$post->title}}</td>
                            <td style="width:30%">

                                @if ($post->trashed())

                                    <a href="{{route('blog-posts.restore', $post->slug)}}"
                                        class="btn btn-success my-2"><i class="fa fa-sync fa-spin fa-fw"></i>Restore</a>
                                    
                                        <form action="{{route('blog-posts.destroy', $post->slug)}}" method="post">
                                            @csrf
                                            @method("DELETE")
                                            <button type="submit" class="btn btn-danger ">Delete</button>
                                        </form>
                                        
                                @else 
                                    <a href="{{route('blog-posts.show', $post->slug)}}"
                                        class="btn btn-info btn-sm">Details</a>
                                @endif
                            </td>
                            
                        </tr>
                    @endforeach
                </table>
                <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                      {{ $posts->links() }}
                    </ul>
                  </div>
           @endif
       </div>
   </div>
    </div>
</div>
@endsection