@extends('master.layout')
@section('style')
<link href="https://fonts.googleapis.com/css2?family=Lobster&family=Roboto:ital,wght@0,400;0,900;1,300;1,400&display=swap" rel="stylesheet">
<link href="{{asset('assets/styles/admin/login_admin.css')}}" rel="stylesheet" />
@endsection
@section('title')
Admin Login 
@endsection
 
@section('content')
<body>
  <h1 class="title">Admin Login</h1>
  <form action="{{ route('login_admin') }}" method="post" role="form">
    @csrf
  <div class="box">
    <div class="form">
      <h2>Log in</h2>
      <div class="inputBox">
        <input type="email" name="email" required>
        <span>Email</span>
        <i></i>
      </div>
      <div class="inputBox">
        <input type="password" name="passe" required>
        <span>Password</span>
        <span class="error">
                        @error('login')
                        {{$message}}
                        @enderror
        </span>
        <i></i>
      </div>
      <div class="links">
        <a href="#">Forgot Password?</a>
      </div>
      <input type="submit" class="bottom" value="Login">
      </form>
    </div>
  </div>
</body>

@endsection