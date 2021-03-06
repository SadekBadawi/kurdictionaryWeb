@extends('layouts/fullLayoutMaster')

@section('title', 'Login Page')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-auth.css')) }}">
@endsection

@section('content')
<div class="auth-wrapper auth-v1 px-2">
  <div class="auth-inner py-2">
    <!-- Login v1 -->
    <div class="card mb-0">
      <div class="card-body">
        <a href="javascript:void(0);" class="brand-logo">
          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 461.9 61.3" style="enable-background:new 0 0 461.9 61.3;width: 240px;height: 32px;" xml:space="preserve">

            <g>
              <g>
                <path style="fill:#7367f0;" d="M183.2,28.4c0,13.6-7.7,21.3-20.9,21.3h-15.1V7.1h15.1C175.5,7.1,183.2,14.8,183.2,28.4z M177.2,28.4    c0-10.5-5.6-16-15-16H153v31.9h9.3C171.6,44.4,177.2,39,177.2,28.4z"/>
                <path style="fill:#7367f0;" d="M190,6.9c0-2.5,1.8-4.1,4-4.1c2.3,0,4,1.6,4,4.1c0,2.5-1.7,4.1-4,4.1C191.7,11,190,9.4,190,6.9z M191.1,17.8    h5.7v32h-5.7V17.8z"/>
                <path style="fill:#7367f0;" d="M204.5,33.8c0-9.9,6.3-17.1,16.9-17.1c3.2,0,5.5,0.4,7.7,1.4v5.1c-2.1-0.9-4.6-1.5-7.9-1.5    c-6.9,0-11,4.8-11,11.9c0,7.1,3.5,11.9,10.7,11.9c2.9,0,5.7-0.6,8.3-1.8v5.1c-1.9,0.9-5.3,1.7-8.6,1.7    C210,50.7,204.5,44.1,204.5,33.8z"/>
                <path style="fill:#7367f0;" d="M257.2,44.1v4.8c-2.7,1.2-5.5,1.6-8.7,1.6c-7.2,0-10.4-3.7-10.4-11.7V23.1h-5.3v-5.3h5.4l1.6-7.7h4.1v7.7    h12.7v5.3h-12.7v15.2c0,5.2,1.7,7.1,6.6,7.1C252.6,45.4,255.1,44.9,257.2,44.1z"/>
                <path style="fill:#7367f0;" d="M262,6.9c0-2.5,1.8-4.1,4-4.1c2.3,0,4,1.6,4,4.1c0,2.5-1.7,4.1-4,4.1C263.8,11,262,9.4,262,6.9z M263.2,17.8    h5.7v32h-5.7V17.8z"/>
                <path style="fill:#7367f0;" d="M276.5,33.8c0-10.4,6.2-17.1,16.1-17.1c9.8,0,15.8,6.5,15.8,16.8c0,10.4-6.2,17.1-16.1,17.1    C282.5,50.7,276.5,44.1,276.5,33.8z M302.7,33.7c0-7.5-4-11.9-10.2-11.9c-6.2,0-10.2,4.5-10.2,11.9c0,7.5,4,11.9,10.2,11.9    C298.7,45.7,302.7,41.2,302.7,33.7z"/>
                <path style="fill:#7367f0;" d="M344.7,30v19.7H339V30.6c0-6-2.7-8.7-7.7-8.7c-3.3,0-6.8,1.5-9.4,4.6v23.3h-5.7v-32h4.9l0.5,3.4    c2.9-2.9,6.6-4.4,10.8-4.4C340.8,16.8,344.7,21.4,344.7,30z"/>
                <path style="fill:#7367f0;" d="M378.3,29.9v19.9h-4.9l-0.3-3c-2.7,2.4-6.3,3.9-11.1,3.9c-6.8,0-10.6-3.5-10.6-9.6c0-6,4.4-9.8,11.9-9.8    c3.7,0,6.3,0.5,9.3,1.5v-3.2c0-5.1-2.6-7.5-8.1-7.5c-4,0-7.5,0.8-10.3,2.1v-5.4c3-1.2,6.7-2,10.5-2    C374.4,16.8,378.3,21.1,378.3,29.9z M372.6,42.1v-4.9c-2.7-0.9-5.7-1.4-8.2-1.4c-4.6,0-7.2,1.5-7.2,5.1c0,3.7,2.6,5,6.2,5    C367.1,45.9,370.2,44.6,372.6,42.1z"/>
                <path style="fill:#7367f0;" d="M405.9,17.2v5.5c-1.1-0.4-2.1-0.5-3.4-0.5c-3.8,0-6.8,2-9.1,5.5v22h-5.7v-32h4.9l0.6,4c2.7-3.5,6.3-5,9.9-5    C404,16.8,405.1,16.9,405.9,17.2z"/>
                <path style="fill:#7367f0;" d="M440.6,17.8l-13.3,31.8l-4.5,11.7h-5.8l4.8-11.7L408,17.8h6.7l10,25.4l9.6-25.4H440.6z"/>
              </g>
              <path style="fill:#7367f0;" d="M8.6,53.2h122.1c3.5,0,6.4-2.9,6.4-6.4V10c0-3.5-2.9-6.4-6.4-6.4H8.6c-3.5,0-6.4,2.9-6.4,6.4v36.8   C2.3,50.4,5.1,53.2,8.6,53.2z"/>
              <g>
                <path style="fill:#ffffff;" d="M49.2,47.4h-9.4l-6.1-10.9c-1.5-2.5-2.5-4.5-5.5-4.5h-3.8v15.5h-8.3V9.5h8.3v14.8H28c2.9,0,4.2-2.1,5.8-4.5    l6.3-10.3H49L40.1,24c-0.9,1.4-1.9,2.9-3.5,3.7c1.8,1,3.1,2.9,4.2,4.9L49.2,47.4z"/>
                <path style="fill:#ffffff;" d="M61.9,9.5v22.4c0,6,2.3,9.5,7.7,9.5c5.4,0,7.7-3.6,7.7-9.5V9.5h8.3v22c0,10.4-4.9,17-16,17    c-11.2,0-15.9-6.3-15.9-16.8V9.5H61.9z"/>
                <path style="fill:#ffffff;" d="M125.2,47.4H116l-4.8-9.7c-0.9-1.8-2.2-3.1-5-3.1h-4.1v12.8h-8.3V9.5h14.8c9.3,0,14.9,4,14.9,12.3    c0,5.4-2.8,8.9-6.7,10.9c1.2,0.7,2,2,2.7,3.3L125.2,47.4z M108.3,27.7c4.1,0,6.8-1.7,6.8-5.7c0-3.7-2.5-5.4-6.8-5.4h-6.2v11.1    H108.3z"/>
              </g>
            </g>
            </svg>
        </a>

<!--
        <h4 class="card-title mb-1">Welcome to Vuexy! ????</h4>
        <p class="card-text mb-2">Please sign-in to your account and start the adventure</p>
-->

        <form class="auth-login-form mt-2" method="POST" action="{{ route('login') }}">
          @csrf
          <div class="form-group">
            <label for="login-email" class="form-label">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="login-email" name="email" placeholder="john@example.com" aria-describedby="login-email" tabindex="1" autofocus value="{{ old('email') }}" />
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
          </div>

          <div class="form-group">
            <div class="d-flex justify-content-between">
              <label for="login-password">Password</label>
              @if (Route::has('password.request'))
              <a href="{{ route('password.request') }}">
                <small>Forgot Password?</small>
              </a>
              @endif
            </div>
            <div class="input-group input-group-merge form-password-toggle">
              <input type="password" class="form-control form-control-merge" id="login-password" name="password" tabindex="2" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="login-password" />
              <div class="input-group-append">
                <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="custom-control custom-checkbox">
              <input class="custom-control-input" type="checkbox" id="remember-me" name="remember-me" tabindex="3" {{ old('remember-me') ? 'checked' : '' }} />
              <label class="custom-control-label" for="remember-me"> Remember Me </label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-block" tabindex="4">Sign in</button>
        </form>
      </div>
    </div>
    <!-- /Login v1 -->
  </div>
</div>
@endsection
