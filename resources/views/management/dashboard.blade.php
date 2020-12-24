@extends('layouts.management')

@section('title', '96Legacy | Dashboard')

@section('page-name', 'Dashboard')

@section('main-content')
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-music"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">MP3 Songs</span>
                  <span class="info-box-number">
                    {{ $songs }}
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-video"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Videos</span>
                  <span class="info-box-number">{{ $videos }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
  
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
  
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-headphones-alt"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Beats</span>
                  <span class="info-box-number">{{ $beats }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Members</span>
                  <span class="info-box-number">{{ $users }}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-newspaper"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Blog Posts</span>
                  <span class="info-box-number">2,000</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-gray elevation-1"><i class="fas fa-shopping-cart"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Sales</span>
                  <span class="info-box-number">2,000</span>
                </div>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
@endsection
    
