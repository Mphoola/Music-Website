@extends('layouts.management')

@section('title')
96Legacy | User | {{ $user->name }}
@endsection

@section('page-name')
User Medias | {{ $user->name }}
@endsection
    
@section('main-content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ $user->songs->count() }} Mp3s</h3>
          {{--  <a href="{{ route('users.create') }}" class="btn btn-success btn-round float-right">Upload New user</a>  --}}
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-bordered table-hover table-hover text-nowrap">
            <thead>
           
                @if ($user->songs->count() != 0)
           
                    <tr>
                        <th>Title-Artist</th>
                        <th>Producer</th>
                        <th style="width: 14%">Dowloads</th>
                        <th style="width: 14%">Show</th>
                    </tr>
                  @endif
        
            </thead>
            <tbody>
                @forelse ($user->songs as $s)
                <tr>
                    <td>{{ $s->full_details }}</td>
                    <td>{{ $s->producer }}</td>
                    <td>{{ $s->downloads->count() }}</td>
                
                    <td>
                        <a href="{{ route('songs.show', $s->id) }}" class="btn btn-info btn-round btn-sm">View More</a>
                    </td>
                @empty
                    
                @endforelse
            </tr>
              
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ $user->videos->count() }} Videos</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-bordered table-hover table-hover text-nowrap">
            <thead>
           
                @if ($user->videos->count() != 0)
           
                    <tr>
                        <th>Title-Artist</th>
                        <th>Producer</th>
                        <th style="width: 14%">Dowloads</th>
                        <th style="width: 14%">Show</th>
                    </tr>
                  @endif
        
            </thead>
            <tbody>
                @forelse ($user->videos as $v)
                <tr>
                    <td>{{ $v->full_details }}</td>
                    <td>{{ $v->producer }}</td>
                    <td>{{ $v->downloads->count() }}</td>
                
                    <td>
                        <a href="{{ route('videos.show', $v->id) }}" class="btn btn-info btn-round btn-sm">View More</a>
                    </td>
                @empty
                    
                @endforelse
            </tr>
              
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">{{ $user->beats->count() }} Beats</h3>
          
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-bordered table-hover table-hover text-nowrap">
            <thead>
                 @if ($user->beats->count() != 0)
           
                    <tr>
                        <th>Title</th>
                        <th>Producer</th>
                        <th style="width: 14%">Dowloads</th>
                        <th style="width: 14%">Show</th>
                    </tr>
                  @endif
            </thead>
            <tbody>
                @forelse ($user->beats as $b)
                <tr>
                    <td>{{ $b->title }}</td>
                    <td>{{ $b->producer }}</td>
                    <td>{{ $b->downloads->count() }}</td>
                
                    <td>
                        <a href="{{ route('beats.show', $b->id) }}" class="btn btn-info btn-round btn-sm">View More</a>
                    </td>
                @empty
                    
                @endforelse
            </tr>
              
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
</div>
@endsection