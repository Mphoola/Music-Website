{{-- 
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>96Legacy | Admin | login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('96/css/fontawesome.css') }}">
  <link rel="shortcut icon" href="{{ asset('testEnd/images/96.png') }}" type="image/x-icon">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('96/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>96Legacy</b>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mb-1">
        <a href="">I forgot my password</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('96/js/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('96/js/bootstrap.bundle.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('96/js/adminlte.min.js') }}"></script>

</body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>96Legacy | Admin | login</title>
    <link rel='stylesheet' href='{{ asset('testEnd/css/styles.min.css') }}'>
    <link rel="stylesheet" href="{{ asset('testEnd/css/page.min.css') }}">
    <link rel="stylesheet" href="{{ asset('testEnd/css/fontawesome.min.css') }}">
</head>
<body>
    <div class="main-content">
        
    <section class="section text-white py-10 h-100vh" style="background-image: url({{ asset('testEnd/images/us.png') }})" data-overlay="6">
        <canvas class="constellation" data-radius="300"></canvas>
        <div class="container ">
            <h3 class="text-center text-white mb-2">96Legacy</h3>
            <p class="lead text-center">Login to start your session</p>
            <div class="row gap-y input-glass">
                <form class="col-md-4 col-xl-4 mx-auto input-border" method="POST"
                    action="{{ route('dashboard.login') }}">
                    @csrf
                    @if (session()->has('errors'))
                        <div class="alert alert-danger">
                            {{ session()->get('errors') }}
                        </div>
                    @endif

                  <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" required
                    value="{{ old('email') }}">
                
                  </div>
    
                  <div class="form-group">
                    <input type="password" name="password" class="form-control form-control-lg" minlength="8" placeholder="Password" required>
                  </div>
    
                  <button type="submit" class="btn btn-block btn-xl btn-success">Login</button>
                  <p class="small mt-3 opacity-90"><a href="#">Forget Password?</a></p>
                </form>
              </div>
        </div>
      </section>
    </div>

    <script src="{{ asset('testEnd/js/page.min.js') }}"></script>
    <script src="{{ asset('testEnd/js/fontawesome.js') }}"></script>
    <script src="{{ asset('testEnd/js/script.js') }}"></script>
</body>
</html>
