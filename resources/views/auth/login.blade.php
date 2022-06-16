@extends('user')
@section('content')
    <div class="settings_container" >
        <div class="forms">
            <div class="form login">
                <span class="title">Login</span>

                <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="input-field">
                    <input id="email" placeholder="Enter your email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="input-field">
                    <input id="password" type="password" placeholder="Enter your password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="input-field button">
                    <input type="submit" value="Login" name="submit">
                </div>

                <div class="login-signup">
                    <span class="text">Not a member?
                    <a href="{{ route('register') }}" class="text signup-link">Signup now</a>
                    </span>
                </div>
            </form>
        </div>
    </div>
@endsection
