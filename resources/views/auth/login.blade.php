@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row m-t-10">
        <div class="col-md-5 offset-3">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-key"></i>
                {{ __('Login') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="login_form">
                        @csrf
                        <div class="form-group">
                            <div class="form-field">
                                <i class="fa fa-user"></i>
                                <input id="email" placeholder="Email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-field">
                                <i class="fa fa-lock"></i>
                                <input id="password" placeholder="Password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-2">
                                <button type="submit" class="btn btn-submit">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="login_page--call_to_action">
                Not registered?
                <a href="/register" class="login_page--register_link" target="_self">
                    SIGN UP NOW!
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
