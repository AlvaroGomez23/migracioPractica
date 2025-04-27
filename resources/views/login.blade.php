<!-- resources/views/auth/login.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/estilsLS.css') }}">
    <title>Formulario de Login</title>
    <script src="https://www.google.com/recaptcha/api.js?render=6LfHsokqAAAAADoBhjjekIvi6UkOZpCqFvAjrEQ7"></script>
</head>
<body>
    <div class="login-container">
        <h2>Iniciar Sessió</h2>
        <form action="{{ route('auth.login') }}" method="POST" id="login-form">
            @csrf
            <input type="email" name="email" class="input-field" placeholder="Email" value="{{ old('email') }}">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <input type="password" name="contrasenya" class="input-field" placeholder="Contrasenya">
            @error('contrasenya')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="remember">Recorda'm <input type="checkbox" name="remember" id="remember"> </label>

            <button id="login-button" class="botons" 
                data-sitekey="reCAPTCHA_site_key" 
                data-callback='onSubmit' 
                data-action='submit'>Login</button>
        </form>

        @if ($errors->has('oauth'))
            <div class="error">
                {{ $errors->first('oauth') }}
            </div>
        @endif

        <div>
            <a href="{{ route('auth.google.redirect') }}">
                <img class="icon" src="https://www.keyweo.com/wp-content/uploads/2022/03/el-logo-g-de-google.png" alt="Google Logo">
            </a>

            <a href="{{ route('github') }}">
                <img class="icon" src="{{ asset('fotos/icons/garrapinyades.png') }}" alt="GitHub Logo">
            </a>

            <a href="{{ route('auth.google.redirect') }}" class="btn btn-google">
                Inicia sessió amb Google
            </a>
        </div>

        <form action="{{ url('/') }}">
            <input type="submit" value="Tornar" class="botons">
        </form>
        <a href="{{ route('recuperarContrasenyaGet') }}" class="forgot-password">Contrasenya oblidada?</a>

        <div class="signup-link">
            No tens compte? <a href="{{ route('signin') }}">Enregistra't</a>
        </div>
    </div>

    <script>
        grecaptcha.ready(function() {
            document.getElementById('login-form').addEventListener('submit', function(event) {
                event.preventDefault();
                grecaptcha.execute('6LfHsokqAAAAADoBhjjekIvi6UkOZpCqFvAjrEQ7', {action: 'login'}).then(function(token) {
                    const recaptchaInput = document.createElement('input');
                    recaptchaInput.type = 'hidden';
                    recaptchaInput.name = 'g-recaptcha-response';
                    recaptchaInput.value = token;
                    document.getElementById('login-form').appendChild(recaptchaInput);
                    document.getElementById('login-form').submit();
                });
            });
        });
    </script>
</body>
</html>
