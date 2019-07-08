@extends('admin.layouts.app')
@section('content')
    <body class="fp-page">
    <div class="fp-box">
        <div class="logo">
            <a href="javascript:void(0);">Admin<b>BSB</b></a>
            <small>Admin BootStrap Based - Material Design</small>
        </div>
        <div class="card">
            <div class="body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                        <form method="POST" action="{{ route('admin.password.update') }}">
                            @csrf
                            <div class="msg">
                                Reset your password.
                            </div>

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="input-group">
                           <span class="input-group-addon">
                            <i class="material-icons">email</i>
                           </span>
                                <div class="form-line">
                                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ $email ?? old('email') }}" required autofocus>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong style="color: red">{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="input-group">
                           <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                           </span>
                                <div class="form-line">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="New Password">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong style="color: red">{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="input-group">
                           <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                           </span>
                                <div class="form-line">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Re-enter Password">

                                </div>
                            </div>
                            <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit">RESET PASSWORD</button>
                        </form>
                    </div>
                </div>
            </div>
@endsection
