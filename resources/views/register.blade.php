<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    @vite(['resources/sass/login.scss', 'resources/js/login.js'])

</head>
<body>
<div class="login-wrap">
    <div class="login-container">
        <div class="login-content">
            <div class="login-form">
                <h2>Sign up</h2>
                <form method="POST" class="register-form" id="login-form">
                    <div class="form-group">
                        <label for="your-name">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </label>
                        <input type="text" name="user-name" id="user-name" placeholder="Your Name">
                    </div>
                    <div class="form-group">
                        <label for="your-email">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </label>
                        <input type="email" name="user-email" id="user-email" placeholder="Your Email">
                    </div>
                    <div class="form-group">
                        <label for="your-password">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </label>
                        <input type="password" name="user-password" id="user-password" placeholder="Your Password">
                    </div>
                    <div class="form-group">
                        <label for="re-password">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </label>
                        <input type="password" name="re-password" id="re-password" placeholder="Repeat Your Password">
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remember-me" id="remember-me" class="agree-term">
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
</body>
</html>
