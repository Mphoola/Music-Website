@extends('layouts.management')

@section('title', '96Legacy | Categories')

@section('page-name', 'Updating Category')
    
@section('main-content')
<div class="card">
    <div class="card-header">
      <h3 class="card-title">Editing | {{ $category->name }}</h3>      
    </div>
    <div class="card-body">
        
        <form role="form" action="{{ route('categories.update', $category->id) }}" method="POST" >
            @csrf
            @method('PUT')
            <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" value="{{ $category->name }}"
            required minlength="3">
            </div>
                
            <button type="submit" class="btn btn-success">Change</button>
        
        </form>
          
    </div>
    
</div>  
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">All Categories</a></li>
        <li class="breadcrumb-item active">Update {{ $category->name }}</li>
    </ol>
@endsection

