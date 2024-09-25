@extends('frontend.layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-lg-5 col-md-6 col-sm-6">
        <div class="card">
          <div class="card-title text-center border-bottom">
            <h2 class="p-3">Register</h2>
          </div>
          <div class="card-body">
            <form>
                <div class="mb-4">
                  <label for="name" class="form-label required">Full Name</label>
                  <input type="text" name="name" class="form-control" id="name" />
                </div>
              <div class="mb-4">
                <label for="email" class="form-label required">Email</label>
                <input type="text" name="email" class="form-control" id="email" />
              </div>
              <div class="mb-4">
                <label for="password" class="form-label required">Password</label>
                <input type="password" name="password" class="form-control" id="password" />
              </div>
              <div class="mb-4">
                <label for="password" class="form-label required">Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" id="confirm-password" />
              </div>
              <div class="d-grid">
                <button type="submit" class="btn custom-login-btn">Register</button>
              </div>
              <div class="mb-4 mt-3 d-flex justify-content-center">
                <label for="remember" class="form-label">Already a registere? </label>&nbsp;
                <a href="{{ route('login') }}">Login</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection