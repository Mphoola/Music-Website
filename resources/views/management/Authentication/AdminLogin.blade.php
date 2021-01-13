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
