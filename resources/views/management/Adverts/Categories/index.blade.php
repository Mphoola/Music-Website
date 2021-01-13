@extends('layouts.management')

@section('title', '96Legacy | Marketing | Advert Categories')

@section('page-name', 'Advert Categories')
    
@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('advert.index') }}">All Ads</a></li>
        <li class="breadcrumb-item active">Advert Categories</li>
    </ol>
@endsection
@section('main-content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">All Advert Categories</h3>
          <button type="button" class="float-right btn btn-success btn-round" data-toggle="modal" data-target="#modal-default">
            Add new
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-bordered table-hover table-hover text-nowrap">
            <thead>
              @if ($categories->count() != 0)
              <tr>
                <th>Type</th>
                <th style="width: 14%">Width</th>
                <th style="width: 14%">Hieght</th>
                <th style="width: 14%">Ads Count</th>
                <th style="width: 14%">Actions</th>
              </tr>
            @endif
            </thead>
            <tbody>
                @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->type }}</td>
                    <td>{{ $category->width }}px</td>
                    <td>{{ $category->height}}px</td>
                    <td>{{ $category->adverts->count()}}</td>
                    <td>
                        <a href="" class="btn btn-info btn-round btn-sm">Edit</a>
                        <a href="" class="btn btn-danger ml-1 btn-round btn-sm">Delete</a>
                    </td>
                @empty
                    <div class="alert alert-warming text-capitalize text-xl-center">No categories uploaded</div>
                @endforelse
            </tr>
              
          </table>
        </div>
        <!-- /.card-body -->
      </div>
    
      <!-- /.card -->
    </div>
</div>

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
          <form role="form" action="{{ route('advert_categories.store') }}" method="POST">
            @csrf
              <div class="form-group">
                <label for="name">Type</label>
                <input type="text" class="form-control" name="type" placeholder="e.g. banner, pop-up etc"
                required minlength="3">
              </div>
              <div class="form-group">
                <label for="height">Height</label>
                <input type="number" class="form-control" name="height" placeholder="what will be height of ads"
                required minlength="2">
              </div>
              <div class="form-group">
                <label for="width">Width</label>
                <input type="number" class="form-control" name="width" placeholder="what will be width of ads"
                required minlength="2">
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
@endsection