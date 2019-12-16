<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>

    <div class="container">
    <form method="POST" class="form-style" action="{{ route('login') }}">
        @csrf
        <div class="header">
            <div class="example-icon" >Login Now</div>
            <small>Login to the system</small>
        </div>
        <hr>
        <div class="content">
            <label for="inp" class="inp">
                <input id="email inp" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                <span class="label">Username</span>
                @error('email')
                <span class="invalid feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="border"></span>
            </label>


            <label for="inp" class="inp">
                <input id="password inp"  type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                <span class="invalid feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span class="label">Password</span>
                <span class="border"></span>
            </label>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>
                <span class="label">{{ __('Remember Me') }}</span>
                <span class="border"></span>

        </div>
        <hr>
        <div class="footer">

            <div class="btntwo">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="bton login">
                        {{ __('Login') }}
                    </button>
                    @if (Route::has('register'))
                        <a class="bton forgot" href="{{ route('register') }}">
                            {{ __('Register') }}
                        </a>
                    @endif
                    <span class="border"></span>
                </div>

            </div>
            <hr>
            <div class="btnalone">
                @if (Route::has('password.request'))
                    <a class="bton register" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </div>
    </form>
</div>

</body>
</html>


