@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('My Uploads') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <ul class="list-group">
                        <a href="{{ route('myAudios') }}">
                            <li class="list-group-item">Audios</li>
                        </a>
                        <a href="{{ route('myVideos') }}">
                            <li class="list-group-item">Videos</li>
                        </a>
                        <a href="{{ route('myBeats') }}">
                            <li class="list-group-item">Beats</li>
                        </a>
                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('My Beats') }}
                    <a href="{{ route('myBeatCreate') }}" class="btn btn-success btn-round btn-sm float-right">Upload New</a>
                </div>

                <div class="card-body">
                    <div class="card-body table-responsive p-0">
                        <table class="table table-bordered table-hover table-hover text-nowrap">
                          <thead>
                            @if ($beats->count() != 0)
                            <tr>
                              <th>Title</th>
                              <th>Producer</th>
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
                                  <td>{{ $beat->producer }}</td>
                                  <td>{{ $beat->category->name }}</td>
                                  <td>{{ $beat->downloads->count() }}</td>
                                  <td>
                                      <a href="" class="btn btn-info btn-round btn-sm">View More</a>
                                  </td>
                              @empty
                                  <div class="alert alert-warming text-capitalize text-xl-center">
                                      You have not uploaded any  beat. Click the about green button to upload
                                  </div>
                              @endforelse
                          </tr>
                            
                        </table>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
