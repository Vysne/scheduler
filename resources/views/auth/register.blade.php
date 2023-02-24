@extends('layouts.app')

@section('content')
<div class="login-wrap">
    <div class="login-container">
        <div class="login-content">
            <div class="login-form">
                <h2>Sign up</h2>
                <form method="POST" action="{{ route('register') }}" class="register-form" id="login-form">
                    @csrf
                    <div class="form-group">
                        <label for="name">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </label>
                        {{--                        class=form-control--}}
                        <input type="text" name="name" id="name" placeholder="Your Name" class="@error('name') is-invalid @enderror" value="{{old('name')}}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </label>
                        <input type="email" name="email" id="email" placeholder="Your Email" class="@error('email') is-invalid @enderror" value="{{old('email')}}" required autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </label>
                        <input type="password" name="password" id="password" placeholder="Your Password" class="@error('password') is-invalid @enderror" required autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </label>
                        <input type="password" class="" name="password_confirmation" id="password-confirm" placeholder="Repeat Your Password" required autocomplete="new-password">
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remember-me" id="remember-me" class="agree-term">
{{--                        TODO Add JS to agree terms checkbox--}}
                        <label for="remember-me" class="label-agree-term">
                            <span class="login-checkbox no-before">
                                <span></span>
                            </span>
                            I agree all statements in
                            <a href="#" class="term-service">Terms of service</a>
                        </label>
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value="Register">
                    </div>
                </form>
            </div>
            <div class="login-image">
                <figure>
                    <img src="{{asset('img/register-image.jpg')}}" alt="Log in image">
                </figure>
                <a href="{{url('login')}}" class="login-image-link">Already have an account</a>
            </div>
        </div>
    </div>
</div>
@endsection
