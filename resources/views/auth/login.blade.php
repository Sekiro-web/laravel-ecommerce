<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>Log In</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/css/auth.css') }}">
</head>

<body class="align">
    <div class="grid align__item">
        <div class="register">
            <h2>Log In</h2>
            <form method="POST" action="{{ route('login') }}" class="form">
                @csrf
                {{-- Email --}}
                <div class="form__field">
                    <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email"
                        placeholder="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                {{-- Password --}}
                <div class="form__field">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required placeholder="password" autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-check">
                    <label class="form-check-label" for="remember">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        {{ __('Remember Me') }}
                    </label>
                </div>
                <br>
                <div class="form__field">
                    <input type="submit" value="Log In">
                </div>
            </form>
            <p>
                @if (Route::has('password.request'))
                    <a class="auth-link text-black" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </p>
            <p>Don't have an account? <a href="{{ url('/register') }}">Create</a></p>
            <p><a href="{{ url('/') }}">Cancel</a></p>
        </div>
    </div>
</body>

</html>
