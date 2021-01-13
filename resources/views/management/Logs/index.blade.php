@extends('layouts.management')

@section('title', '96Legacy | Activity Logs')

@section('page-name', 'Activity Logs')
    
@section('main-content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Logs</h3>
          
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-bordered table-hover table-hover text-nowrap">
            <thead>
              @if ($logs->count() != 0)
                <tr>
                  <th>Description</th>
                  <th>Subject Type</th>
                  <th style="width: 14%">Subject Id</th>
                  <th style="width: 14%">Causer Type</th>
                  <th style="width: 14%">Causer Id</th>
                  <th style="width: 14%">Time</th>
                  <th style="width: 14%">Properties</th>

                </tr>
              @endif
            </thead>
            <tbody>
                @forelse ($logs as $log)
                <tr>
                    <td>{{ $log->description }}</td>
                    <td>{{ $log->subject_type }}</td>
                    <td>{{ $log->subject_id }}</td>
                    <td>{{ $log->causer_type }}</td>
                    <td>{{ $log->causer_id }}</td>
                    <td>{{ $log->created_at->toDayDateTimeString() }}</td>
                    <td>{{ $log->properties }}</td>
                
                @empty
                    <h1 class="alert alert-warming text-capitalize text-xl-center">No logs have been registered yet</h1>
                @endforelse
                
            </tr>
              
          </table>
        </div>

        <!-- /.card-body -->
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
              {{ $logs->links() }}
            </ul>
          </div>
      </div>
      <!-- /.card -->
    </div>
</div>
@endsection