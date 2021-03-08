<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('testEnd/css/page.min.css') }}" rel="stylesheet">
    <link href="{{ asset('testEnd/css/style.min.css') }}" rel="stylesheet">
    <title>96Legacy</title>
</head>
<body>
    <main class="main-content text-center">
        <div class="container-fluid h-100vh bg-gray ">
  
          <h1 class="display-1 text-muted mb-7">Page Not Found</h1>
          <p class="lead"><strong>Sorry! </strong> Seems you're looking for something that doesn't exist.</p>
          <br>
          <button class="btn btn-warning w-150 mr-2" type="button" onclick="window.history.back();">Go back</button>
          <a class="btn btn-success " href="/">Return Home</a>
  
        </div>
    </main>


    <script src="{{ asset('testEnd/js/page.min.js') }}"></script>
    <script src="{{ asset('testEnd/js/script.js') }}"></script>
</body>
</html>