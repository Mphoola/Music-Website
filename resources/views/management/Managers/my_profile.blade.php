@extends('layouts.management')

@section('title', '96Legacy | Me')

@section('page-name', 'My Profile')
    
@section('main-content')
<div class="row">
    <div class="col-12">
      <!-- Profile Image -->
      <div class="card card-primary card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle"
                 src="{{ asset($user->image) }}"
                 alt="User profile picture">
          </div>

          <h3 class="profile-username text-center">{{ $user->name }}</h3>

          <p class="text-muted text-center">{{ $role }}</p>

          <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
              <b>Music Uploads</b> <a class="float-right">{{ $music_uploads }}</a>
            </li>
            <li class="list-group-item">
              <b>Video Uploads</b> <a class="float-right">{{ $video_uploads }}</a>
            </li>
            <li class="list-group-item">
              <b>Video Aprrovals</b> <a class="float-right">{{ $video_approvals }}</a>
            </li>
            <li class="list-group-item">
              <b>Beats Uploads</b> <a class="float-right">{{ $beat_uploads }}</a>
            </li>
            <li class="list-group-item">
              <b><center>Bio</center></b> <p class="text-center">{{ $user->bio }}</p>
            </li>
          </ul>

          <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modal-default"><b>Update</b></button>
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
        <h4 class="modal-title">Updating Profile</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form role="form" action="{{ route('my_profile_update', $user->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Enter name here"
              required minlength="3">
            </div>
            <div class="form-group">
              <label for="bio">Bio</label>
              <input type="bio" class="form-control" name="bio" value="{{ $user->bio }}" placeholder="if you are a blog writer"
              maxlength="255">
            </div>
            <div class="form-group">
              <img src="{{ asset($user->image) }}" alt="No available" class="img-thumbnail img-fluid">
              <label for="image">Image</label>
              <input type="file" name="image" id="image">
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
</div
@endsection