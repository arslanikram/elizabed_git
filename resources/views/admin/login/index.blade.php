@extends('admin.layouts.login')

@section('content')
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <div class="brand-logo">
                <img src="{{env('ADMIN_ASSETS_PATH')}}upload/images/elizabed/logo.png" alt="logo">
              </div>
               @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{Session::get('success')}}
                        </div>
                    @elseif(Session::has('fail'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{Session::get('fail')}}
                        </div>
                    @endif
              <!-- <h4>Hello! let's get started</h4> -->
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" action="{{url('admin/login')}}" method="post">
                @csrf
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <!-- <a href="#" class="auth-link text-black">Forgot password?</a> -->
                </div>
                <!-- <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="fab fa-facebook-f mr-2"></i>Connect using facebook
                  </button>
                </div> -->
                <!-- <div class="text-center mt-4 font-weight-light">
                  Don't have an account? <a href="register.html" class="text-primary">Create</a>
                </div> -->
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->

      @stop
