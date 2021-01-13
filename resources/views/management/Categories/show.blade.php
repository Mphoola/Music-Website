@extends('layouts.management')

@section('title' )
    96Legacy | Categories | {{ $category->name }}
@endsection 

@section('page-name')
 Genre : {{ $category->name }}
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
        <li class="breadcrumb-item active">{{ $category->name }}</li>
    </ol>
@endsection
    
@section('main-content')
  <div class="card">
    <div class="card-header">
      <h3 class="card-title text-uppercase">{{ $category->songs->count() }} {{  $category->name }} Songs</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
      <table class="table table-bordered  table-hover">
        <thead>                  
          <tr>
            <th>Artist</th>
            <th >Title</th>
            <th >Producer</th>
            <th >View</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($songs as $s)
          
            <tr>
                <td>{{ $s->artist }}</td>
              <td>
                {{ $s->title }}
              </td>
              <td>
                {{ $s->producer }}
              </td>
              <td>
                <a href="{{ route('songs.show', $s->id) }}" class="btn btn-info">More</a>
              </td>
            </tr>
          
          @empty
              <h4 class="lead text-center">No Songs  yet</h4>
          @endforelse
          
        </tbody>
      </table>
    </div>
    <div class="card-footer clearfix">
      <ul class="pagination pagination-sm m-0 float-right">
        {{ $songs->links() }}
      </ul>
    </div>
  </div>

    <div class="card">
      <div class="card-header">
        <h3 class="card-title text-uppercase">{{ $category->videos->count() }} {{  $category->name }} Videos</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-bordered  table-hover">
          <thead>                  
            <tr>
              <th>Artist</th>
              <th >Title</th>
              <th >Producer</th>
              <th >View</th>

            </tr>
          </thead>
          <tbody>
            @forelse ($videos as $s)
              <tr>
                <td>{{ $s->artist }}</td>
                <td>
                  {{ $s->title }}
                </td>
                <td>
                  {{ $s->producer }}
                </td>
                <td>
                  <a href="{{ route('videos.show', $s->id) }}" class="btn btn-info">More</a>
                </td>
              </tr>
            @empty
                <h4 class="lead text-center">No videos  yet</h4>
            @endforelse
            
          </tbody>
        </table>
      </div>
      <div class="card-footer clearfix">
        <ul class="pagination pagination-sm m-0 float-right">
          {{ $videos->links() }}
        </ul>
      </div>
    </div>

  <div class="card">
    <div class="card-header">
      <h3 class="card-title text-uppercase">{{ $category->beats->count() }} {{  $category->name }} Beats</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
      <table class="table table-bordered  table-hover">
        <thead>                  
          <tr>
            <th >Title</th>
            <th >Producer</th>
            <th >View</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($beats as $s)
            <tr>
              <td>
                {{ $s->title }}
              </td>
              <td>
                {{ $s->producer }}
              </td>
              <td>
                <a href="{{ route('beats.show', $s->id) }}" class="btn btn-info">More</a>
              </td>
            </tr>
          @empty
              <h4 class="lead text-center">No Beats  yet</h4>
          @endforelse
          
        </tbody>
      </table>
    </div>
    <div class="card-footer clearfix">
      <ul class="pagination pagination-sm m-0 float-right">
        {{ $beats->links() }}
      </ul>
    </div>
  </div>
  
  
@endsection