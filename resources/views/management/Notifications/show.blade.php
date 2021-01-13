@extends('layouts.management')

@section('title', '96Legacy | Notification | Video Approval')

@section('page-name', 'Video Details')

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('notifications') }}">Notifications</a></li>
        <li class="breadcrumb-item active">Video Approval</li>
    </ol>
@endsection
    
@section('main-content')
<div class="row">
 
</div>
<div class="row">
  <div class=" mb-3 col-12 mb-1">
    <h3 class="font-weight-bold">Watch it before you approve</h3>
    
   <div class="">
    <video  controls class="" style="margin-left: auto">
      <source src="{{ asset($video->location) }}" type="video/mp4">
      Your browser does not support HTML5 video.
    </video>
   </div>
</div>
    <div class="col-12">
        <div class="card">
            
            <div class="card-body">
              <div class="d-flex justify-content-between border-bottom mb-2">
                <p class="">
                    <span class="text-muted">Title</span>
                </p>
                <p class="d-flex flex-column text-right">
                  <span class="font-weight-bold">
                    {{ $video->title }}
                  </span>
                </p>
              </div>
              <div class="d-flex justify-content-between border-bottom mb-2">
                <p class="">
                    <span class="text-muted">Artist Name</span>
                </p>
                <p class="d-flex flex-column text-right">
                  <span class="font-weight-bold">
                    {{ $video->artist }}
                  </span>
                </p>
              </div>
              <div class="d-flex justify-content-between border-bottom mb-2">
                <p class="">
                    <span class="text-muted">Producer</span>
                </p>
                <p class="d-flex flex-column text-right">
                  <span class="font-weight-bold">
                    {{ $video->producer }}
                  </span>
                </p>
              </div>
              <div class="d-flex justify-content-between border-bottom mb-2">
                <p class="">
                    <span class="text-muted">Released Date</span>
                </p>
                <p class="d-flex flex-column text-right">
                  <span class="font-weight-bold">
                    {{ $video->produced_date }}
                  </span>
                </p>
              </div>
              
              <div class="d-flex justify-content-between border-bottom mb-2">
                <p class="">
                    <span class="text-muted">Category</span>
                </p>
                <p class="d-flex flex-column text-right">
                  <span class="font-weight-bold">
                    {{ $video->category->name }}
                  </span>
                </p>
              </div>
              <div class="d-flex justify-content-between border-bottom mb-2">
                <p class="">
                    <span class="text-muted">Market</span>
                </p>
                <p class="d-flex flex-column text-right">
                  <span class="font-weight-bold">
                    {{ $video->market }}
                  </span>
                </p>
              </div>
              <div class="d-flex justify-content-between border-bottom mb-2">
                <p class="">
                    <span class="text-muted">Cost</span>
                </p>
                <p class="d-flex flex-column text-right">
                  <span class="font-weight-bold">
                    MWK {{ $video->amount }}.00
                  </span>
                </p>
              </div>
              
              
              <!-- /.d-flex -->
            </div>
          </div>
    </div>
</div>
<div class="col-12 mt-3">
    <a href="{{ route('videos.edit', $video->id) }}" class="btn btn-success btn-block btn-round btn-hover text-white">Approve</a>
    <a class="btn btn-danger btn-block btn-round btn-hover mb-1 text-white">Disapprove</a>
</div>
@endsection