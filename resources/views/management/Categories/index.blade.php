@extends('layouts.management')

@section('title', '96Legacy | Categories')

@section('page-name', 'Categories')
    
@section('main-content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">All Categories / Genres</h3>

      <button type="button" class="float-right btn btn-success btn-round" data-toggle="modal" data-target="#modal-default">
        Add new
      </button>
      
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive p-0">
      <table class="table table-bordered table-hover table-hover text-nowrap">
        <thead>                  
          <tr>
            <th>Name</th>
            <th style="width: 30%">Number of songs</th>
            <th colspan="3">Action</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($categories as $category)
            <tr>
              <td>{{ $category->name }}</td>
              <td>
                {{ $category->songs_count }}
              </td>
              <td>
                <div class="d-flex flex-row">

                
                  <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-round btn-xs btn-success mx-1">Edit</a>
                
                  <button type="submit" class="btn btn-round btn-xs btn-danger mx-1"
                  data-id="{{ $category->id }}" data-action="{{ route('categories.destroy', $category->id) }}"
                  onclick="deleteConfirmation({{ $category->id }})">Delete</button>
                  
                  <a href="{{ route('categories.show', $category->id) }}" class="btn btn-round btn-xs btn-primary mx-1">Show Songs</a>
                </div>
              </td>
            </tr>
          @empty
              <h4 class="lead text-center text-capitalize text-xl-center">No categories yet</h4>
          @endforelse
          
        </tbody>
      </table>
    </div>

    <!-- /.card-body -->
    <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add new Category</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form role="form" action="{{ route('categories.store') }}" method="POST">
              @csrf
                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Enter category name"
                  required minlength="3">
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Save</button>
          </div>
        </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  </div>

  
@endsection
