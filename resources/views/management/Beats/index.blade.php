@extends('layouts.management')

@section('title', '96Legacy | Beats')

@section('page-name', 'Beats')
    
@section('main-content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">All Beats</h3>
          <a href="{{ route('beats.create') }}" class="btn btn-success btn-round float-right">Upload New Beat</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-bordered table-hover table-hover text-nowrap">
            <thead>
              @if ($beats->count() != 0)
              <tr>
                <th>Title</th>
                <th style="width: 14%">Category</th>
                <th style="width: 14%">Downloads</th>
                <th style="width: 14%">Action</th>
              </tr>
            @endif
            </thead>
            <tbody>
                @forelse ($beats as $beat)
                <tr>
                    <td>{{ $beat->title }}</td>
                    <td>{{ $beat->category->name }}</td>
                    <td>{{ $beat->downloads->count() }}</td>
                    <td>
                        <a href="{{ route('beats.show', $beat->id) }}" class="btn btn-info btn-round btn-sm">View More</a>
                    </td>
                @empty
                    <div class="alert alert-warming text-capitalize text-xl-center">No beats uploaded</div>
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