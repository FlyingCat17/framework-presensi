@extends('templates/header')

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <form action="login" method="POST">
          <div class="mb-3">
            <label for="username" class="form-label mt-3">Username</label>
            <input type="username" class="form-control" id="username" aria-describedby="emailHelp" name="username" value="{{ username }}">
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
{{ errors->username }}