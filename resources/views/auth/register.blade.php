<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fix CSS path to use Laravel asset helper -->
    <link rel="stylesheet" type="text/css" href="{{ asset('home/css/login.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <form class="login-form validate-form" method="POST" action="{{ route('register') }}">
                @csrf
                <h1 class="login-title">
                    Welcome
                </h1>
                <div class="login-logo">
                    <img src="{{ asset('images/MMY Champions.png') }}" alt="logo">
                </div>
                <div class="form-group validate-input">
                    <input class="form-input @error('name') is-invalid @enderror" type="text" name="name" id="name" placeholder=" " value="{{ old('name') }}" required>
                    <label class="input-label" for="name">Name</label>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group validate-input">
                    <input class="form-input @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder=" " value="{{ old('email', request('email')) }}" required>
                    <label class="input-label" for="email">Email</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group validate-input">
                    <input class="form-input @error('phone') is-invalid @enderror" type="number" name="phone" id="phone" placeholder=" " value="{{ old('phone') }}" required>
                    <label class="input-label" for="phone">Phone Number</label>
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group validate-input">
                    <input class="form-input @error('address') is-invalid @enderror" type="text" name="address" id="address" placeholder=" " value="{{ old('address') }}" required>
                    <label class="input-label" for="address">Address</label>
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group validate-input">
                    <input class="form-input @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder=" " required>
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
                <!-- Add password confirmation field -->
                <div class="form-group validate-input">
                    <input class="form-input" type="password" name="password_confirmation" id="password_confirmation" placeholder=" " required>
                    <label class="input-label" for="password_confirmation">Confirm Password</label>
                    <span class="toggle-password">
                        <i class="zmdi zmdi-eye"></i>
                    </span>
                </div>
                <div class="form-actions">
                    <!-- Fix button text to match registration -->
                    <button class="login-button" type="submit">
                        <span class="button-bg"></span>
                        <span class="button-text">Register</span>
                    </button>
                </div>
                <div class="login-footer">
                    <span class="footer-text">
                        Already registered?
                    </span>
                    <a class="footer-link" href="{{ route('login') }}">
                        Login
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