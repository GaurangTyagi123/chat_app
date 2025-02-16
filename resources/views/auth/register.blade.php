@extends('layouts.app')

@section('content')
<div class="register__container">
    <form method="POST" action="{{ route('register') }}" class="login__form">
        @csrf
        <div class="login__field">
            <label for="name" class="login__label">{{ __('Name') }}</label>
            <div class="login__input__group">
                <input id="name" type="text" class="login__input ??form-control @error('name') is-invalid @enderror" name="name"
                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="login__field">
            <label for="email" class="login__label">{{ __('Email Address') }}</label>

            <div class="login__input__group">
                <input id="email" type="email" class="login__input form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email">

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
                <input id="password" type="password" class="login__input form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="login__field">
            <label for="password-confirm"
                class="login__label">{{ __('Confirm Password') }}</label>

            <div class="login__input__group">
                <input id="password-confirm" type="password" class="login__input form-control" name="password_confirmation" required
                    autocomplete="new-password">
            </div>
        </div>

        <div class="login__field">
            <div class="login__btn">
                <button type="submit" class="btn--login">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
    </form>
</div>
@endsection