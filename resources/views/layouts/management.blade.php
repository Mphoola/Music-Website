
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>

      @yield('title', '96Legacy')

  </title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('96/css/fontawesome.css') }}">
  <link rel="shortcut icon" href="{{ asset('testEnd/images/us.png') }}" type="image/x-icon">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('96/css/adminlte.min.css') }}">

  <!-- toastr -->
  <link rel="stylesheet" href="{{ asset('96/css/toastr.min.css') }}">


  <link rel="stylesheet" href="{{ asset('96/css/Chart.min.css') }}">

  @yield('summernote-css')
  
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          
            <span class="badge badge-warning navbar-badge"> 
              {{ Auth::guard('admin')->user()->unreadNotifications->count() }}
            </span>
          
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          
          <span class="dropdown-header">
            {{ Auth::guard('admin')->user()->unreadNotifications->count() }} unread Notifications
          </span>

          <div class="dropdown-divider"></div>
          <a href="{{ route('notifications') }}" class="dropdown-item">
            <i class="fas fa-music mr-2"></i> 
            {{ Auth::guard('admin')
            ->user()->unreadNotifications
            ->where('type', 'App\Notifications\newSongUploaded')
            ->count() }}
            song upload alert
            
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('notifications') }}" class="dropdown-item">
            <i class="fas fa-headphones-alt mr-2"></i> 
            {{ Auth::guard('admin')
                    ->user()->BeatUploadAlert }}
            beat upload alert
            
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('notifications') }}" class="dropdown-item">
            <i class="fas fa-video mr-2"></i> 
            {{ Auth::guard('admin')
                     ->user()->unreadNotifications
                     ->where('type', 'App\Notifications\newVideoUploaded')
                     ->count() }} 
            video approvals
            
          </a>
          <div class="dropdown-divider"></div>
          <a href="{{ route('notifications') }}" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{ asset('testEnd/images/us.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">96Legacy</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset(Auth::guard('admin')->user()->image) }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            {{ Auth::guard('admin')->user()->name}}
          </a>
          
          <a class="btn btn-outline-danger btn-cirlce btn-sm" href="{{ route('dashboard.logout') }}"
              onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('dashboard.logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link @if (Str::startsWith(Request::path(), 'management/dashboard') )
                active
            @endif">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('songs.index') }}" class="nav-link @if (Str::startsWith(Request::path(), 'management/song') )
                  active
              @endif">
              <i class="nav-icon fas fa-music"></i>
              <p>
                Music
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('videos.index') }}" class="nav-link  @if (Str::startsWith(Request::path(), 'management/video') )
                  active
              @endif">
              <i class="nav-icon fas fa-video"></i>
              <p>
                Videos
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('beats.index') }}" class="nav-link  @if (Str::startsWith(Request::path(), 'management/beat') )
                  active
              @endif">
              <i class="nav-icon fas fa-headphones-alt"></i>
              <p>
                Beats
              </p>
            </a>
          </li>
          @if (Auth::guard('admin')->user()->can('edit category'))
              
          <li class="nav-item">
            <a href="{{ route('categories.index') }}" class="nav-link  @if (Str::startsWith(Request::path(), 'management/categor') )
            active
            @endif">
            <i class="nav-icon fas fa-layer-group"></i>
            <p>
              Categories
            </p>
          </a>
        </li>
        
        @endif
        @if (Auth::guard('admin')->user()->can('see posts'))
          <li class="nav-item">
            <a href="{{ route('blog-posts.index') }}" class="nav-link  @if (Str::startsWith(Request::path(), 'management/blog') )
                  active
              @endif">
              <i class="nav-icon fas fa-newspaper"></i>
              <p>
                Blog
              </p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="#" class="nav-link  @if (Str::startsWith(Request::path(), 'management/sales') )
                  active
              @endif">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Sales
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="{{ route('advert.index') }}" class="nav-link @if (Str::startsWith(Request::path(), 'management/advert') )
                  active
              @endif">
              <i class="nav-icon fas fa-ad"></i>
              <p>
                Adverts
              </p>
            </a>
          </li>
          @if (Auth::guard('admin')->user()->can('see users'))
          <li class="nav-item">
            <a href="{{ route('list_users') }}" class="nav-link @if (Str::startsWith(Request::path(), 'management/user') )
                  active
              @endif">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          @endif
          @if (Auth::guard('admin')->user()->can('see admins'))
          <li class="nav-item">
            <a href="{{ route('list_admins') }}" class="nav-link @if (Str::startsWith(Request::path(), 'management/admin') )
                  active
              @endif">
              <i class="nav-icon fas fa-unlock-alt"></i>
              <p>
                Managers
              </p>
            </a>
          </li>
          @endif
          <li class="nav-item">
            <a href="{{ route('my_profile', Auth::guard('admin')->id()) }}" class="nav-link @if (Str::startsWith(Request::path(), 'management/my-profile') )
              active
          @endif">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                Profile
              </p>
            </a>
          </li>
         @if (Auth::guard('admin')->user()->can('change settings'))
             
         <li class="nav-item">
           <a href="#" class="nav-link">
             <i class="nav-icon fas fa-cogs"></i>
             <p>
               Settings
              </p>
            </a>
          </li>
          @endif 
         
          @if (Auth::guard('admin')->user()->can('see logs'))
            <li class="nav-item">
              <a href="{{ route('logs.index') }}" class="nav-link @if (Str::startsWith(Request::path(), 'management/activity') )
                  active
              @endif">
                <i class="nav-icon fas fa-tasks"></i>
                <p>
                  Activity Log
                </p>
              </a>
            </li>
            @endif
         

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">
                
                @yield('page-name', '96Legacy')
            
            </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            {{--  <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>  --}}

            @yield('breadcrumb')

          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        {{-- @include('partials.info') --}}
        @yield('main-content')

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('96/js/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('96/js/bootstrap.bundle.min.js') }}"></script>


<!-- AdminLTE App -->
<script src="{{ asset('96/js/adminlte.min.js') }}"></script>



<!-- toastr -->
<script src="{{ asset('96/js/toastr.min.js') }}"></script>

<!-- charts js -->
<script src="{{ asset('96/js/chart.min.js') }}"></script>


<script>
  @if (Session::has('success'))
    toastr.success('{{ session()->get('success') }}')
  @endif
  @if (Session::has('error'))
    toastr.error('{{ session()->get('error') }}')
  @endif
</script>
@yield('scripts')
</body>
</html>
