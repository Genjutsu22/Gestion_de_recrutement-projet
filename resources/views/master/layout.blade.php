<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @yield('style')
    <script src="https://kit.fontawesome.com/876d7409f1.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" href="{{asset('assets/images/logo.png')}}"  type="image/png">
    <title> @yield('title')</title>
</head>
<body>  

@if(Session::get('error'))
<div id="alert" class="alert alert-danger" style="display:none; text-align:center; z-index:100;">
<i class="fas fa-exclamation-circle"></i>   <strong> {{session('error')}}</strong> 
</div>
@elseif(session('success'))
    <div id="alert" class="alert alert-success" style="display:none; text-align:center; color:aliceblue; background-color:forestgreen; z-index:100;">
        <i class="fas fa-check-circle"></i>   <strong>{{session('success')}}</strong> 
    </div>
@endif

@yield('content') 
<script>
     $('a.profile').on('click', function () {
        location.reload(true);
    });
  
    $(document).ready(function(){
        $("#alert").show();
     });
     setTimeout(function() {
        $("#alert").fadeOut();
     }, 5000);
</script>
</body>
</html>