@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center m-t-10">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header"><i class="fa fa-lock"></i> {{ __('Password Reset') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <div class="form-field">
                                <i class = "fa fa-envelope"></i>
                                <input id="email" placeholder = "Email Address" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-submit">
                                    {{ __('Reset') }}
                                </button>
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
