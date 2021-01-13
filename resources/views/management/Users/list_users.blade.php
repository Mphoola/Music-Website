@extends('layouts.management')

@section('title', '96Legacy | Users')

@section('page-name', 'Users')
    
@section('main-content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">All Users</h3>
          {{--  <a href="{{ route('users.create') }}" class="btn btn-success btn-round float-right">Upload New user</a>  --}}
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
          <table class="table table-bordered table-hover table-hover text-nowrap">
            <thead>
              @if ($users->count() != 0)
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th style="width: 14%">Mp3s</th>
                  <th style="width: 14%">Beats</th>
                  <th style="width: 14%">Vedio</th>
                  <th style="width: 14%">More</th>
                </tr>
              @endif
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->songs_count }}</td>
                    <td>{{ $user->beats_count }}</td>
                    <td>{{ $user->videos_count }}</td>
                    <td>
                        <a href="{{ route('list_user_media', $user->id) }}" class="btn btn-info btn-round btn-sm">View More</a>
                    </td>
                @empty
                    <h1 class="alert alert-warming text-capitalize text-xl-center">No users have been registered yet</h1>
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