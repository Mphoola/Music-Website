@extends('layouts.management')

@section('title', '96Legacy | Videos')

@section('page-name', 'Videos')
    
@section('main-content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">All Videos</h3>
          <a href="{{ route('videos.create') }}" class="btn btn-success btn-round float-right">Upload New Video</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-bordered table-hover table-hover text-nowrap">
            <thead>
              @if ($videos->count() != 0)
                <tr>
                  <th>Title</th>
                  <th>Artist</th>
                  <th style="width: 14%">Category</th>
                  <th style="width: 14%">Downloads</th>
                  <th style="width: 14%">Action</th>
                </tr>
              @endif
            </thead>
            <tbody>
                @forelse ($videos as $video)
                <tr>
                    <td>{{ $video->title }}</td>
                    <td>{{ $video->artist }}</td>
                    <td>{{ $video->category->name }}</td>
                    <td>{{ $video->downloads_count }}</td>
                    <td>
                        <a href="{{ route('videos.show', $video->id) }}" class="btn btn-info btn-round btn-sm">View More</a>
                    </td>
                @empty
                    <h1 class="alert alert-warming text-capitalize text-xl-center">No videos uploaded</h1>
                @endforelse
            </tr>
              
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
          {{ $videos->links() }}
        </ul>
      </div>
      <!-- /.card -->
    </div>
</div>
@endsection