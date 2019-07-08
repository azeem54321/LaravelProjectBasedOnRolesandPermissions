@extends('admin.layouts.master')
@section('content')
    <div class="container">
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <div class="card">
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="header" style="background: #f44336">
                    <h2>
                        {{Auth::guard('admin')->user()->name}}
                    </h2>
                </div>
                <div class="body">
                    <form method="POST" accept-charset="UTF-8" class="form-group"
                          enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="pull-right">
                            @if (session('error_password'))
                                <span class="alert alert-info">
                              {{ session('error_password') }}
                             </span>
                            @endif
                        </div>
                        <label for="name">{{ 'Name' }}</label>

                        <div class="form-group">
                            <div class="form-line">
                                <input class="form-control" name="name" type="text" id="name"
                                       value="{{ Auth::guard('admin')->user()->name}}" required>
                                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <label for="email">{{ 'Email' }}</label>

                        <div class="form-group">
                            <div class="form-line">
                                <input class="form-control" name="email" type="email" id="email"
                                       value="{{ Auth::guard('admin')->user()->email}}" readonly>
                                {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>


                        <label for="old_password">{{ 'Old Password' }}</label>

                        <div class="form-group">
                            <div class="form-line">
                                <input class="form-control" name="old_password" type="password"
                                       id="old_password">
                                {!! $errors->first('old_password', '<p class="help-block">:message</p>') !!}
                            </div>
                            <label for="password">{{ 'New Password' }}</label>

                            <div class="form-group">
                                <div class="form-line">
                                    <input class="form-control" name="password" type="password" id="password">
                                    {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>


                            <label for="password_confirmation">{{ 'Password Confirmation' }}</label>

                            <div class="form-group">
                                <div class="form-line">
                                    <input class="form-control" name="password_confirmation" type="password"
                                           id="password_confirmation">
                                    {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>


                            <label for="image">{{ 'Profile Image' }}</label>

                            <div class="form-group">
                                <div class="form-line">
                                    <input class="form-control" name="image" type="file" id="image">
                                    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            @if(Auth::guard('admin')->user()->image)
                                <div class="pull-right"><img
                                            src="{{asset('images/profile_image/'.Auth::guard('admin')->user()->image)}}"
                                            height="100px" width="100px"></div>
                            @endif
                            <button type="submit"
                                    class="btn btn-primary btn-lg m-t-15 waves-effect col-md-offset-5">
                                UPDATE
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
