@extends('layouts.management')

@section('title', '96Legacy | Audios')

@section('page-name', 'Audios')
    
@section('main-content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">

          <a href="{{ route('songs.create') }}" class="btn btn-success btn-round btn-sm">Upload New Song</a>
          <div class="card-tools">
            <form action="{{ route('song_search') }}" method="get">
              @csrf
              <div class="input-group input-group-sm" style="width: 250px;">
                <input type="text" name="query" class="form-control float-right" placeholder="Search music audio">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
              </div>
            </form>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-bordered table-hover table-hover text-nowrap">
            <thead>
              @if ($songs->count() != 0)
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
                @forelse ($songs as $song)
                <tr>
                    <td>{{ $song->title }}</td>
                    <td>{{ $song->artist }}</td>
                    <td>{{ $song->category->name }}</td>
                    <td>{{ $song->downloads_count }}</td>
                    <td>
                        <a href="{{ route('songs.show', $song->id) }}" class="btn btn-info btn-round btn-sm">View More</a>
                    </td>
                @empty
                    <div class="alert alert-warming text-capitalize text-xl-center">No songs uploaded</div>
                @endforelse
            </tr>
              
          </table>
        </div>
        
        <!-- /.card-body -->
      </div>
      <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
          {{ $songs->links() }}
        </ul>
      </div>
      <!-- /.card -->
    </div> 
    
</div>
@endsection