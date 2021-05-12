@extends('loginlayout')

@section('content')
<div class="main-content">
    <!-- Header -->
    <div class="header bg-future py-7 py-lg-5 pt-lg-9">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
              <h1 class="text-dark">{{ __('Reset Password') }}</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> {{ $error }}
                </div>
            @endforeach
            @if (session()->has('message'))
                <div class="alert alert-{{ session()->get('type') }} alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                    </button>
                    {{ session()->get('message') }}
                </div>
            @endif
            @if (session()->has('status'))
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
                    </button>
                    {{ session()->get('status') }}
                </div>
            @endif
          <div class="card bg-secondary border-0 mb-0">
            <div class="card-header bg-transparent pb-3">
            </div>
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-dark mb-5">
                <small>{{__('Recover your account')}}</small>
              </div>
              <form role="form" action="{{route('user.password.request')}}" method="post">
                @csrf
                <!--div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control" placeholder="{{ __('Email') }}" type="email" name="email" required>
                      @if ($errors->has('email'))
                        <span class="error form-error-msg ">
                          <strong>{{ $errors->first('email') }}</strong>
                        </span>
                      @endif
                  </div>
                </div-->
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input id="password" class="form-control" placeholder="{{ __('Password') }}" type="password" name="password" required>
                      @if ($errors->has('password'))
                        <span class="error form-error-msg ">
                          <strong>{{ $errors->first('password') }}</strong>
                        </span>
                      @endif
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text text-future"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input id="password-confirm" class="form-control" placeholder="{{ __('Re-Enter Password') }}" type="password" name="password_confirmation" required>
                      @if ($errors->has('password_confirmation'))
                        <span class="error form-error-msg ">
                          <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                      @endif
                  </div>
                </div>
                <input type="hidden" name="token" value="{{$token}}">
                <div class="text-center">
                  <button type="submit" class="btn btn-success my-4">{{__('Continue')}}</button>
                </div>
                <div class="row mt-3">
                  <div class="col-6">
                    <a href="{{route('user.password.request')}}" class="text-dark"><small>{{__('Forgot password?')}}</small></a>
                  </div>
                  <div class="col-6 text-right">
                    <a href="{{route('register')}}" class="text-dark"><small>{{__('Create an account')}}</small></a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@stop