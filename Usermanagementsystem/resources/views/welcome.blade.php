<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<style>
   body{
    background:#1abc9c;
}
</style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center h-100 vh-100">
    <div class="card bg-white">
        <h2 class="p-4">Welcome</h2>
        <div class="card-body p-4">
            <div class="d-flex flex-column justify-content-between">
            <p class="h3">Join With Us <a href="{{url('/register')}}" class="btn btn-primary mx-2">Sign Up</a></p>
            <p class="h3">Already Joined <a href="" class="btn btn-warning">Login</a></p>
            </div>
        </div>
    </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>