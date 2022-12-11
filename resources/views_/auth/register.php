@extends('templates/header')
@section('content')

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <form action="register" method="POST">
          <div class="mb-3">
            <label for="firstName" class="form-label mt-3">Fisrt Name</label>
            <input type="text" class="form-control" id="firstName" aria-describedby="emailHelp" name="firstName" value="{{ $data['firstName'] }}">
            <label for="lastName" class="form-label mt-3">Last Name</label>
            <input type="text" class="form-control" id="lastName" aria-describedby="emailHelp" name="lastName" value="{{ $data['lastName'] }}">
            <label for="username" class="form-label mt-3">Username</label>
            <input type="username" class="form-control" id="username" aria-describedby="emailHelp" name="username" value="{{ $data['username'] }}">
            <label for="password" class="form-label mt-3">Password</label>
            <input type="password" class="form-control" id="password" aria-describedby="emailHelp" name="password">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            <input type="submit" class="btn btn-primary" value="Login">
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
{{ $data }}