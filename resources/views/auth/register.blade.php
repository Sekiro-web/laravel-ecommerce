{{-- <x-auth_layout>
    <form class="pt-3" method="POST" action="{{ route('register') }}">
        @csrf
        <div class="form-group">
            <input id="first_name" type="text" class="form-control @error('name') is-invalid @enderror"
                placeholder="Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                name="password" required placeholder="Password" autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password"
                name="password_confirmation" required autocomplete="new-password">
        </div>
    </form>
</x-auth_layout> --}}

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
            <form method="POST" action="{{ route('register') }}" class="form">
                @csrf
                {{-- Name --}}
                <div class="form__field">
                    <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name"
                        placeholder="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
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
                    <input id="password" type="password" class="@error('password') is-invalid @enderror"
                        name="password" required placeholder="Password" autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                {{-- Confirm Password --}}
                <div class="form__field">
                    <input id="password-confirm" type="password" placeholder="Confirm Password"
                        name="password_confirmation" required autocomplete="new-password">
                </div>
                {{-- check --}}
                <div class="form-check">
                    <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input">
                        I agree to all Terms &amp; Conditions
                        <i class="input-helper"></i></label>
                    </label>
                </div>
                <br>
                {{-- submit --}}
                <div class="form__field">
                    <input type="submit" value="Register">
                </div>
            </form>
            <p>Already have an account? <a href="{{ url('/login') }}" class="text-primary">Login</a></p>
            <p><a href="{{ url('/') }}">Cancel</a></p>
        </div>
    </div>
</body>

</html>
