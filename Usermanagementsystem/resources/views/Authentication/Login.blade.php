<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
   body{
    background:#1abc9c;
   }
    .input-field{
border:1px solid black;
padding: 5px 7px;
    }

</style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center vh-100 h-100">
  <div class="card">
    <div class="card-header">
      <h3>Login</h3>
    </div>
  <div class="card-body">
    <!-- Check if there's a success message in the session -->
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

    <form action="{{ url('/login/post') }}" method="POST">
      {{ csrf_field() }}

<div class="mb-3">
<div class="input-field d-flex">
  <i class="fa-solid fa-envelope fs-2 mx-3"></i>
  <input type="email" placeholder="Email" style="border:none;" name="email" class="form-control">

</div>
</div>
<div class="mb-3">


<div class="input-field d-flex">
<i class="fa-solid fa-key fs-2 mx-3"></i>
  <input type="password" placeholder="Password" name="password" style="border:none;" class="form-control">

</div>
</div>

<button class="btn btn-primary w-100">Login</button>
<div class="m-2">
<a href="{{ route ('auth.google')}}" class="btn btn-danger w-100">Login With Google</a>
</div>


<p>Don't have an Account ? <a href="{{url('/register')}}">Register</a></p>
</form>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
