@extends('layouts.management')

@section('title', '96Legacy | Beats:single detail')

@section('page-name', 'Beat Detail')

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('beats.index') }}">Beats</a></li>
        <li class="breadcrumb-item active">Details:</li>
    </ol>
@endsection
    
@section('main-content')
<div class="justify-content-center mb-3">
    <h3 class="font-weight-bold">Listen to it</h3>
    <audio controls class="bg-white">
        <source src="{{ asset($beat->location) }}" type="audio/ogg">
        Your browser does not support the audio element.
    </audio>
</div>
<div class="row">
    <div class="col-mb-6 mb-1 justify-content-center">
      <img src="{{ asset($beat->cover_image) }}" alt="{{ __('Cover Image') }}" width="450px" height="435px"
      class="img-responsive rounded mx-3">
    </div>
    <div class="col-md-6">
        <div class="card">
            
            <div class="card-body">
              <div class="d-flex justify-content-between border-bottom mb-2">
                <p class="">
                    <span class="text-muted">Title</span>
                </p>
                <p class="d-flex flex-column text-right">
                  <span class="font-weight-bold">
                    {{ $beat->title }}
                  </span>
                </p>
              </div>
            
              <div class="d-flex justify-content-between border-bottom mb-2">
                <p class="">
                    <span class="text-muted">Producer</span>
                </p>
                <p class="d-flex flex-column text-right">
                  <span class="font-weight-bold">
                    {{ $beat->producer }}
                  </span>
                </p>
              </div>
              <div class="d-flex justify-content-between border-bottom mb-2">
                <p class="">
                    <span class="text-muted">Released Date</span>
                </p>
                <p class="d-flex flex-column text-right">
                  <span class="font-weight-bold">
                    {{ $beat->produced_date }}
                  </span>
                </p>
              </div>
              <div class="d-flex justify-content-between border-bottom mb-2">
                <p class="">
                    <span class="text-muted">Downloads</span>
                </p>
                <p class="d-flex flex-column text-right">
                  <span class="font-weight-bold">
                    {{ $beat->downloads_count }}
                  </span>
                </p>
              </div>
              <div class="d-flex justify-content-between border-bottom mb-2">
                <p class="">
                    <span class="text-muted">Category</span>
                </p>
                <p class="d-flex flex-column text-right">
                  <span class="font-weight-bold">
                    {{ $beat->category->name }}
                  </span>
                </p>
              </div>
              <div class="d-flex justify-content-between border-bottom mb-2">
                <p class="">
                    <span class="text-muted">Market</span>
                </p>
                <p class="d-flex flex-column text-right">
                  <span class="font-weight-bold">
                    {{ $beat->market }}
                  </span>
                </p>
              </div>
              <div class="d-flex justify-content-between border-bottom mb-2">
                <p class="">
                    <span class="text-muted">Cost</span>
                </p>
                <p class="d-flex flex-column text-right">
                  <span class="font-weight-bold">
                    MWK {{ $beat->amount }}.00
                  </span>
                </p>
              </div>
              <div class="d-flex justify-content-between border-bottom mb-2">
                <p class="">
                    <span class="text-muted">Size</span>
                </p>
                <p class="d-flex flex-column text-right">
                  <span class="font-weight-bold">
                    {{ $size }} MB
                  </span>
                </p>
              </div>
              <div class="d-flex justify-content-between border-bottom mb-2">
                <p class="">
                    <span class="text-muted">Comments</span>
                </p>
                <p class="d-flex flex-column text-right">
                  <span class="font-weight-bold">
                    {{ $beat->comments->count() }}
                  </span>
                </p>
              </div>
              
              <!-- /.d-flex -->
            </div>
          </div>
    </div>
</div>
<div class="col-12 mt-3">
    <a href="{{ route('beats.edit', $beat->id) }}" class="btn btn-success btn-block btn-round btn-hover text-white m-2">Edit Details</a>
    <form id="deleteForm" action="{{ route('beats.delete', $beat->id) }}" method="post">
      @csrf
      @method("DELETE")
      
    </form>
    <button data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-block btn-round btn-hover mb-1 text-white">Delete the beat</button>
  </div>
@include('partials.deleteModal')
@endsection


@section('scripts')
    
<script src="{{ asset('js/za.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function(){
    $('#delete').on('click',function(){
      $('#deleteForm').submit();      
		});
	});
  
</script>
  @endsection