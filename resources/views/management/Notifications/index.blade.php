@extends('layouts.management')

@section('title', '96Legacy | Notifications')

@section('page-name', 'Notifications')
    
@section('main-content')
<div class="card">
    <div class="card-header">All Notifications
        <a href="{{ route('notifications.delete.all') }}" class="btn btn-danger btn-sm float-right">Delete All Read</a>
        <a href="{{ route('notifications.markAllAsRead') }}" class="btn btn-info btn-sm float-right">Mark All Read</a>
    </div>
    <div class="card-body" style="border: 1px solid rgb(206, 201, 201)">
        <ul class="list-group">
            @forelse ($notifications as $n)
                <li class="list-group-item" style="
                @if($n->read_at == '')
                background:rgb(152, 159, 160); color:white
                @endif">
                  
                    @if ($n->type == 'App\Notifications\newVideoUploaded')
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-9">
                                    <strong>{{ $n->data['uploader_name'] }}</strong> Uploaded a new video : 
                                    <strong>{{ $n->data['video_details'] }}</strong> : Waiting for your approval
                                </div>
                                <div class="col-md-1">
                                    <a href="{{ route('notifications.show', ['id' => $n->id, 'v' => $n->data['video_id']]) }}" 
                                     class="btn btn-info btn-sm">view</a>
                                </div>
                                <div class="col-md-1">
                                    <a href="{{ route('notifications.markAsRead', $n->id) }}" class="btn btn-primary btn-sm">
                                        Mark
                                    </a>
                                </div>
                                <div class="col-md-1">
                                    <a href="{{ route('notifications.delete', $n->id) }}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash fa-spin"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                </li>
            @empty
                <h4>You dont have any notifications now</h4>
                <div class="">
                    <p>
                        Here is where you receive notifications about whats happening especially when a video 
                        has been added, Waiting for appraoval
                    </p>
                </div>
            @endforelse
        </ul>
    </div>
    <div class="text-center mx-auto">
        {{ $notifications->links() }}
    </div>
</div>
@endsection