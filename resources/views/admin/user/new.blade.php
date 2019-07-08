@extends('admin.layouts.master')
@section('content')
    <div class="container">
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
            <a href="{{ url('/admin/users') }}" title="Back">
                <button class="btn btn-warning btn-sm"><i class="material-icons">arrow_back</i> Back</button>
            </a>
            <div class="card">
                @if ($errors->any())
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="header" style="background: #e2d1d1">
                    <h2>Create User</h2>
                </div>
                <div class="body">
                    <form method="POST" action="{{ url('/admin/users') }}" accept-charset="UTF-8"
                          class="form-horizontal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @include ('admin.user._form', ['formMode' => 'create'])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection