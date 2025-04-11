<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
      <h3>Register</h3>
    </div>
    <span style="color:red;">{{$errors->first('name')}}</span>
    <span style="color:red;">{{$errors->first('email')}}</span>
    <span style="color:red;">{{$errors->first('password')}}</span>
    <span style="color:red;">{{$errors->first('is_role')}}</span>
  <div class="card-body">
    <form action="{{ url('/register/post') }}" method="POST">
      {{ csrf_field() }}
    <div class="mb-3">
<div class="input-field d-flex">
  <i class="fa fa-user fs-2 mx-3"></i>
  <input type="text" placeholder="Name" value="{{ old('name') }}"   name="name" style="border:none;" class="form-control">

</div>
</div>
<div class="mb-3">


<div class="input-field d-flex">
  <i class="fa-solid fa-envelope fs-2 mx-3"></i>
  <input type="email" placeholder="Email" value="{{ old('email') }}"   name="email" style="border:none;" class="form-control">

</div>
</div>
<div class="mb-3">


<div class="input-field d-flex">
<i class="fa-solid fa-key fs-2 mx-3"></i>
  <input type="password" placeholder="Password"   name="password" style="border:none;" class="form-control">

</div>
</div>
<div class="mb-3">
  <div class=" input-field">
    <select name="is_role"  class="form-control" id="">
      <option value="">--Select User Role--</option>
<option {{ old('is_role') == "0" ? : 'selected' }} value="0">User</option>
<option {{ old('is_role') == "1" ? : 'selected' }} value="1">Admin</option>
<option {{ old('is_role') == "2" ? : 'selected' }} value="2">Super User</option>

    </select>
  </div>
</div>
<button class="btn btn-primary w-100">Register</button>
<div class="d-flex">
<p>Alredy Have an Account ? <a href="{{url('/login')}}">Login</a></p>
</div>


</form>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
