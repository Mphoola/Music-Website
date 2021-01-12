@extends('layouts.management')

@section('title', '96Legacy | Dashboard')

@section('page-name', 'Dashboard')

@section('main-content')
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
              <a href="{{ route('songs.index') }}">
                <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-music"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text text-black-50 text-black-50">MP3 Songs</span>
                  <span class="info-box-number text-black-50 text-black-50">
                    {{ $songs }}
                  </span>
                </div>
                <!-- /.info-box-content -->
              </div>
              </a>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <a href="{{ route('videos.index') }}">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-video"></i></span>
    
                  <div class="info-box-content">
                    <span class="info-box-text text-black-50">Videos</span>
                    <span class="info-box-number text-black-50">{{ $videos }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
              </a>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
  
            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>
  
            <div class="col-12 col-sm-6 col-md-3">
              <a href="{{ route('beats.index') }}">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-success elevation-1"><i class="fas fa-headphones-alt"></i></span>
    
                  <div class="info-box-content">
                    <span class="info-box-text text-black-50">Beats</span>
                    <span class="info-box-number text-black-50">{{ $beats }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
              </a>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <a href="{{ route('list_users') }}">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
    
                  <div class="info-box-content">
                    <span class="info-box-text text-black-50">Members</span>
                    <span class="info-box-number text-black-50">{{ $users }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
              </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <a href="{{ route('blog-posts.index') }}">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-dark elevation-1"><i class="fas fa-newspaper"></i></span>
    
                  <div class="info-box-content">
                    <span class="info-box-text text-black-50">Blog Posts</span>
                    <span class="info-box-number text-black-50">{{ $blogs }}</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
              </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <a href="">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-shopping-cart"></i></span>
    
                  <div class="info-box-content">
                    <span class="info-box-text text-black-50">Sales</span>
                    <span class="info-box-number text-black-50">2,000</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
              </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <a href="">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-gray elevation-1"><i class="fas fa-download"></i></span>
    
                  <div class="info-box-content">
                    <span class="info-box-text text-black-50">Downloads</span>
                    <span class="info-box-number text-black-50">2,000</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
              </a>
              <!-- /.info-box -->
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <a href="">
                <div class="info-box mb-3">
                  <span class="info-box-icon bg-light elevation-1"><i class="fas fa-eye"></i></span>
    
                  <div class="info-box-content">
                    <span class="info-box-text text-black-50">Vitors</span>
                    <span class="info-box-number text-black-50">2,00</span>
                  </div>
                  <!-- /.info-box-content -->
                </div>
              </a>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ $music_chart->options['chart_title'] }}</div>
    
                    <div class="card-body">
    
                        {!! $music_chart->renderHtml() !!}
    
                    </div>
    
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"beat_>{{ $beat_chart->options['chart_title'] }}</div>
    
                    <div class="card-body">
    
                        {!! $beat_chart->renderHtml() !!}
    
                    </div>
    
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ $video_chart->options['chart_title'] }}</div>
    
                    <div class="card-body">
    
                        {!! $video_chart->renderHtml() !!}
    
                    </div>
    
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ $blog_chart->options['chart_title'] }}</div>
    
                    <div class="card-body">
    
                        {!! $blog_chart->renderHtml() !!}
    
                    </div>
    
                </div>
            </div>
        </div>
@endsection

@section('scripts')
{!! $music_chart->renderChartJsLibrary() !!}
{!! $music_chart->renderJs() !!}
{!! $beat_chart->renderChartJsLibrary() !!}
{!! $beat_chart->renderJs() !!}
{!! $video_chart->renderChartJsLibrary() !!}
{!! $video_chart->renderJs() !!}
{!! $blog_chart->renderChartJsLibrary() !!}
{!! $blog_chart->renderJs() !!}
@endsection
    
