<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>96Legacy | Admin | Reset Password</title>
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
            <p class="lead text-center">Your password has expired, please change it.</p>
            <div class="row gap-y input-glass">
                <form class="col-md-4 col-xl-4 mx-auto input-border" method="POST"
                    action="{{ route('password.post_expired') }}">
                    @csrf 
    
                  <div class="form-group {{ $errors->has('current_password') ? ' has-error' : '' }}">
                    <input type="password" name="current_password" class="form-control form-control-lg" minlength="8" placeholder="Current Password" required>
                    @if ($errors->has('current_password'))
                        <span class="help-block">
                            <strong class="alert-danger">{{ $errors->first('current_password') }}</strong>
                        </span>
                    @endif
                </div>

                  <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input type="password" name="password" class="form-control form-control-lg" minlength="8" placeholder="New Password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong class="alert-danger">{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                  </div>

                  <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <input type="password" name="password_confirmation" class="form-control form-control-lg" minlength="8" placeholder="Confirm Password" required>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong class="alert-danger">{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                  </div> 
                  
    
                  <button type="submit" class="btn btn-block btn-xl btn-success">Reset</button>
                </form> 
                



                {{-- <form class="col-md-4 col-xl-4 mx-auto input-border" method="POST" action="">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                        

                        <div class="col-md-6">
                            <input id="current_password" type="password" class="form-control form-control-lg" name="current_password" required="">

                            @if ($errors->has('current_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('current_password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control form-control-lg" name="password" required="">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control form-control-lg" name="password_confirmation" required="">

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Reset Password
                            </button>
                        </div>
                    </div>
                </form> --}}
              </div>
        </div>
      </section>
    </div>

    <script src="{{ asset('testEnd/js/page.min.js') }}"></script>
    <script src="{{ asset('testEnd/js/fontawesome.js') }}"></script>
    <script src="{{ asset('testEnd/js/script.js') }}"></script>
</body>
</html>
