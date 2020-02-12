@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <form class="login-form" method="POST" action="{{route('login')}}">
        @csrf
        <div class="card mb-0">
          <div class="card-body">
            <div class="text-center mb-3">
              <i class="icon-reading icon-2x text-slate-300 border-slate-300 border-3 rounded-round p-3 mb-3 mt-1"></i>
              <h5 class="mb-0">{{trans('forms.authentication')}}</h5>
              <span class="d-block text-muted">{{trans('forms.your_credentials')}}</span>
            </div>

            <div class="form-group form-group-feedback form-group-feedback-left">
              <input type="text" name="email" class="form-control" placeholder="{{trans('forms.email')}}">
              <div class="form-control-feedback">
                <i class="icon-user text-muted"></i>
              </div>
              @error('email')
                  <span class="text-danger font-size-xs" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>

            <div class="form-group form-group-feedback form-group-feedback-left">
              <input type="password" name="password" class="form-control" placeholder="{{trans('forms.password')}}">
              <div class="form-control-feedback">
                <i class="icon-lock2 text-muted"></i>
              </div>
              @error('password')
                  <span class="text-danger font-size-xs" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
              @enderror
            </div>


            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-block">{{trans('buttons.signin')}} <i class="icon-circle-right2 ml-2"></i></button>
            </div>

            <div class="form-group text-center text-muted content-divider">
              <span class="px-2">{{trans('lables.dont_have_an_account')}}</span>
            </div>

            <div class="form-group">
              <a href="{{route('register')}}" class="btn btn-light btn-block">{{trans('buttons.signup')}}</a>
            </div>
          </div>
        </div>
      </form>
    </div>
</div>
@endsection
