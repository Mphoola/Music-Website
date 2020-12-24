@extends('layouts.management')

@section('title', '96Legacy | admins')

@section('page-name', 'Admins')
    
@section('main-content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Admins</h3>

          @if (Auth::guard('admin')->user()->can('add new admin'))  
          <button type="button" class="float-right btn btn-success btn-round" data-toggle="modal" data-target="#modal-default">
            Add new
          </button>
          @endif
          
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-bordered table-hover table-hover text-nowrap">
            <thead>
              @if ($admins->count() != 0)
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th style="width: 14%">Role</th>
                  <th style="width: 14%">Permissions</th>
                </tr>
              @endif
            </thead>
            <tbody>
                @forelse ($admins as $admin)
                <tr>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->email }}</td>
                    <td>{{ $admin->getRoleNames() }}</td>
                    <td>{{ $admin->permissions_count }}</td>
                   
                    <td>
                        <a href="{{ route('list_permissions', $admin->id) }}" class="btn btn-info btn-round btn-sm">View More</a>
                    </td>
                @empty
                    <h1 class="alert alert-warming text-capitalize text-xl-center">No admins have been registered yet</h1>
                @endforelse
            </tr>
              
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
</div>

<!-- /.card-body -->
<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add new Manager</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" action="{{ route('add_admin') }}" method="POST">
          @csrf
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" placeholder="Enter name here"
              required minlength="3">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" placeholder="Enter email here"
              required minlength="3">
            </div>
            <div class="form-group">
              <label for="name">Password</label>
              <input type="password" class="form-control" name="password" placeholder="Enter password here"
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
@endsection