@extends('layouts.management')

@section('title', '96Legacy | Marketing | Adverts')

@section('page-name', 'Adverts')
    
@section('main-content')
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
              All adverts
              
            </h3>
            <a href="{{ route('advert_categories.index') }}" class="btn btn-info ml-2 btn-round float-right">Categories</a>
          
          <button type="button" class="float-right btn btn-success btn-round" data-toggle="modal" data-target="#modal-default">
            Place Ad
          </button>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            @if ($errors->any())
            <div class="alert alert-info">
                <ul class="list-group">
                    @foreach ($errors->all() as $error)
                        <li class="list-group-item text-danger">
                            {{ $error }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
                @if ($adverts->count() == 0)
                    <h3 class="text-center">No adverts yet</h3>
                 @else
                     <table class="table table-striped">
                         <tr>
                             <th>Image</th>
                             <th>Type</th>
                             <th>Views</th>
                             <th>Clicks</th>
                             <th>Actions</th>
                             
                         </tr>
                         @foreach ($adverts as $advert)
                             <tr>
                             
                                 <td>
                                     <img style='width:110px;height:120px' src="{{ asset($advert->image_path) }}" alt="N/A">
                                 </td>
                                 <td style="">{{$advert->advert_category->type}}</td>
                                 <td style="">{{$advert->views}}</td>
                                 <td style="">{{$advert->clicks}}</td>
                                 <td style="width:20%">
     
                                    
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <a href="{{route('advert.destroy', $advert->id)}}"
                                                class="btn btn-success btn-sm"><i class="fa fa-edit"></i>Edit</a>
                                        </div>
                                        <div>
                                            <form action="{{route('advert.destroy', $advert->id)}}" id="deleteAd{{ $advrt->id }}" method="post">
                                                @csrf
                                                @method("DELETE")
                                            </form>
                                            <button id="deleteBtn{{ $advrt->id }}" onclick="deleteModal({{ $advrt->id }})"
                                              class="btn btn-danger  btn-round btn-hover  text-white">Delete</button>
                                        </div>
                                    </div>                                            
                                   
                                    
                                 </td>
                                 
                             </tr>
                         @endforeach
                     </table>
                     <div class="card-footer clearfix">
                         <ul class="pagination pagination-sm m-0 float-right">
                           {{ $adverts->links() }}
                         </ul>
                       </div>
                @endif
            </div>
        </div>
        <!-- /.card-body -->
      </div>
    
      <!-- /.card -->
    </div>
</div>

@include('partials.deleteModal')

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add new Advert</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            
          <form role="form" action="{{ route('advert.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label for="name">Alternative word</label>
                <input type="text" class="form-control" name="alt" placeholder="Words that will be displayed if image not found"
                required minlength="3">
              </div>
              <div class="form-group">
                <label for="height">Redirect URL</label>
                <input type="url" class="form-control" name="url" placeholder="Website link *start with https://"
                required minlength="2">
              </div>
              <div class="form-group">
                  <label for="Type">Type of Ad</label>
                  <select name="advert_category_id" id="Type" class="form-control">
                      @foreach ($categories as $item)
                          <option value="{{ $item->id }}" >{{ $item->type }}</option>
                      @endforeach
                  </select>
              </div>
              <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control">
                
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

@section('scripts')
    
<script src="{{ asset('js/za.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function(){
    $('#deleteBtn').on('click',function(){
      $('#deleteModal').modal();      
		});
	});
  
</script>
  @endsection