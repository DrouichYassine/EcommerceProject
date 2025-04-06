<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/login.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <form class="login-form validate-form" method="POST" action="{{ route('login') }}">
                @csrf
                <h1 class="login-title">
                    Welcome
                </h1>
                <div class="login-logo">
                    <img src="{{ asset('images/MMY Champions.png') }}" alt="logo">
                </div>
                <div class="form-group validate-input">
                    <input class="form-input" type="text" name="email" id="email" placeholder=" " value="{{ old('email') }}" required autofocus>
                    <label class="input-label" for="email">Email</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group validate-input">
                    <input class="form-input" type="password" name="password" id="password" placeholder=" " required>
                    <label class="input-label" for="password">Password</label>
                    <span class="toggle-password">
                        <i class="zmdi zmdi-eye"></i>
                    </span>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-actions">
                    <button class="login-button" type="submit">
                        <span class="button-bg"></span>
                        <span class="button-text">Login</span>
                    </button>
                </div>
                <div class="login-footer">
                    <span class="footer-text">
                        Don't have an account?
                    </span>
                    <a class="footer-link" href="{{ route('register') }}">
                        Sign Up
                    </a>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                if (input.type === 'password') {
                    input.type = 'text';
                    this.innerHTML = '<i class="zmdi zmdi-eye-off"></i>';
                } else {
                    input.type = 'password';
                    this.innerHTML = '<i class="zmdi zmdi-eye"></i>';
                }
            });
        });
    </script>
</body>
</html>