@extends('layouts.app')

@section('content')
<div class="login__container">
    <form method="POST" action="{{ route('login') }}" class="login__form">
        @csrf
        <div class="login__field">
            <label for="email" class="login__label">{{ __('Email Address') }}</label>

            <div class="login__input__group">
                <input id="email" type="email" class="login__input @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required  autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="login__field">
            <label for="password" class="login__label">{{ __('Password') }}</label>

            <div class="login__input__group">
                <input id="password" type="password" class="login__input @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="login__field login__field--remember">
            <div class="login__remember">
                <div class="login__input__group">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="login__label--remember" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
            </div>
        </div>

        <div class="login__field">
            <div class="login__btn">
                <button type="submit" class="btn--login">
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="login__link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </div>
    </form>
</div>
@endsection