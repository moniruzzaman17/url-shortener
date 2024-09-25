@extends('frontend.layouts.app')
@section('content')
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="card">
          <div class="card-title text-center border-bottom">
            <h2 class="p-3">Login</h2>
          </div>
          <div class="card-body">
            <form method="POST" enctype="multipart/form-data" id="loginForm">
              <div class="mb-4">
                <label for="email" class="form-label required">Email</label>
                <input type="email" name="email" class="form-control" id="email" />
              </div>
              <div class="mb-4">
                <label for="password" class="form-label required">Password</label>
                <input type="password" name="password" class="form-control" id="password" />
              </div>
              <div class="d-grid">
                <button type="submit" class="btn custom-login-btn">Login</button>
              </div>
              <div class="mb-4 mt-3 d-flex justify-content-center">
                <label for="remember" class="form-label">Not a member? </label>&nbsp;
                <a href="{{ route('register') }}">Register</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@push('scripts')
  <script>
  $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
      $('#loginForm').on('submit', function(e) {
          e.preventDefault();
          $('#emailError').text('');
          $('#passwordError').text('');
  
          // AJAX request
          $.ajax({
              url: '{{ route("login.submit") }}',
              method: 'POST',
              data: $(this).serialize(),
              success: function(response) {
                  if (response.success) {
                      toastr.success(response.message);
                      window.location.href = "{{ route('index') }}";
                  }
                  else{
                    toastr.success("dd");
                  }
              },
            error: function(xhr) {
                var res = xhr.responseJSON;
                if (!res.success && res.errors) {
                    $.each(res.errors, function(field, messages) {
                        $('#' + field + 'Error').text(messages[0]);
                        toastr.error(messages[0]);
                    });
                } else {
                    toastr.error('Something went wrong');
                }
            }
          });
      });
  });
  </script>
@endpush
@endsection