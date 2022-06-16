@extends('user')

@section('content')
    <div class="settings_container" >
        <div class="forms">
            <div class="form login">
                <span class="title">Register</span>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="input-field">
                            <input id="name" type="text" placeholder="Enter your username" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="input-field">
                            <input id="email" type="email" placeholder="Enter your email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="input-field">
                            <input id="password" placeholder="Create a password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="input-field">
                            <input id="password-confirm" placeholder="Confirm a password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="input-field button">
                            <input type="submit" value="Register" name="submit">
                        </div>

                        <div class="login-signup">
                    <span class="text">Already have an account?
                    <a href="{{ route('login') }}" class="text signup-link">Login now</a>
                    </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
