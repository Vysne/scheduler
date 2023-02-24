@extends('layouts.app')

@section('content')
<div class="login-wrap">
    <div class="login-container">
        <div class="login-content">
            <div class="login-image">
                <figure>
                    <img src="{{asset('img/login-image.jpg')}}" alt="Log in image">
                </figure>
                <a href="{{route('register')}}" class="login-image-link">Create an account</a>
            </div>
            <div class="login-form">
                <h2>Sign in</h2>
                <form method="POST" action="{{route('login')}}">
                    @csrf
                    <div class="form-group">
{{--                        TODO Fix label type icons positioning and input styling then input is invalid--}}
{{--                        <label for="email">--}}
{{--                            <i class="fa fa-user" aria-hidden="true"></i>--}}
{{--                        </label>--}}
{{--                        class=form-control--}}
                        <input type="email" name="email" id="email" placeholder="Your Email" class="@error('email') is-invalid @enderror" value="{{old('email')}}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
{{--                        TODO Fix label type icons positioning and input styling then input is invalid--}}
{{--                        <label for="password">--}}
{{--                            <i class="fa fa-lock" aria-hidden="true"></i>--}}
{{--                        </label>--}}
                        <input type="password" name="password" id="password" placeholder="Your Password" class="@error('password') is-invalid @enderror" required autocomplete="current-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remember" id="remember" class="agree-term" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember" class="label-agree-term">
                        <span class="login-checkbox no-before">
                            <span></span>
                        </span>
                            Remember me
                        </label>
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value="Log in">
{{--                            TODO Fix "Forgot Your Password" button positioning and styling--}}
{{--                        @if (Route::has('password.request'))--}}
{{--                            <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                {{ __('Forgot Your Password?') }}--}}
{{--                            </a>--}}
{{--                        @endif--}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
