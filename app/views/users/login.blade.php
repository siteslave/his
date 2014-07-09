@extends('layouts.login')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-7">
      <div class="panel panel-default">
        <div class="panel-heading">
          <span class="fa fa-lock"></span> Login</div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" action="/login" method="post">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <div class="form-group">
              <label for="txtEmail" class="col-sm-3 control-label">
                Email</label>
              <div class="col-sm-9">
                <input type="email" name="email" class="form-control" id="txtEmail" placeholder="Email" required>
              </div>
            </div>
            <div class="form-group">
              <label for="txtPassword" class="col-sm-3 control-label">
                Password</label>
              <div class="col-sm-9">
                <input type="password" name="password" class="form-control" id="txtPassword" placeholder="Password" required>
              </div>
            </div>
            <div class="form-group last">
              <div class="col-sm-offset-3 col-sm-9">
                <button type="submit" class="btn btn-success btn-sm">
                  Sign in</button>
                <button type="reset" class="btn btn-default btn-sm">
                  Reset</button>
              </div>
            </div>
          </form>
        </div>
        <div class="panel-footer">
          Not Registred? <a href="/users/register">Register here</a></div>
      </div>
    </div>
  </div>
</div>

@stop