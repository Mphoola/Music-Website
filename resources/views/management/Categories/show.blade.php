@extends('layouts.management')

@section('title' )
    96Legacy | Categories | {{ $category->name }}
@endsection 

@section('page-name', 'Categories')

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
        <li class="breadcrumb-item active">{{ $category->name }}</li>
    </ol>
@endsection
    
@section('main-content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title text-uppercase">{{ $category->name }} ({{ $category->songs->count() }}) Songs</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table class="table table-bordered">
        <thead>                  
          <tr>
            <th>Artist</th>
            <th >Title</th>
            <th >Producer</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($category->songs as $s)
            <tr>
              <td>{{ $s->artist }}</td>
              <td>
                {{ $s->title }}
              </td>
              <td>
                {{ $s->producer }}
              </td>
            </tr>
          @empty
              <h4 class="lead text-center">No Songs  yet</h4>
          @endforelse
          
        </tbody>
      </table>
    </div>

  
@endsection