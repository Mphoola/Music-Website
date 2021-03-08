@extends('layouts.management')

@section('title', '96Legacy | Songs')

@section('page-name', 'Songs Search Result')
    
@section('main-content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <a href="{{ route('songs.create') }}" class="btn btn-success btn-round btn-sm">Upload New Song</a>
          </h3>

          <div class="card-tools">
            <form action="{{ route('song_search') }}" method="get">
              @csrf
              <div class="input-group input-group-sm" style="width: 250px;">
                <input type="text" name="query" class="form-control float-right" placeholder="Search Mp3">

                <div class="input-group-append">
                  <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
              </div>
            </form>
          </div>
          
        </div>
        <!-- /.card-header -->
        <h3 class="ml-4 mt-1">
            <b>{{ $searchResults->count() }} results found for "{{ request('query') }}"</b>
        </h3>
        <div class="card-body table-responsive p-0">
            
          <table class="table table-bordered table-hover table-hover text-nowrap">
            <thead>
              @if ($searchResults->count() != 0)
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
                @foreach($searchResults as $s)
                <tr>
                    <td>{{ $s->searchable->title }}</td>
                    <td>{{ $s->searchable->artist }}</td>
                    <td>{{ $s->searchable->category->name }}</td>
                    <td>{{ $s->searchable->downloads_count }}</td>
                    <td>
                        <a href="{{ $s->url }}" class="btn btn-info btn-round btn-sm">View More</a>
                    </td>
                </tr>
                @endforeach
            </tbody> 
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
</div>
@endsection