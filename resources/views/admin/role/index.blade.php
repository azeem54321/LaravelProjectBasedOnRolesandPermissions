
@extends('admin.layouts.master')

@section('title', 'Roles & Permissions')
<style>
    .borderdslinecss{
        border-bottom: 5px solid #f44336;

    }
</style>
@section('content')
        <!-- Modal -->
<div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="roleModalLabel">
    <div class="modal-dialog" role="document">
        {!! Form::open(['method' => 'post']) !!}

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="roleModalLabel">Role</h4>
            </div>
            <div class="modal-body">
                <!-- name Form Input -->
                <div class="form-group @if ($errors->has('name')) has-error @endif">
                    {!! Form::label('name', 'Name') !!}
                    <div class="form-line">
                        <input class="form-control" name="name" type="text" id="name"
                               placeholder="Role Name" autocomplete="off"  minlength="4" required>
                        @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                <!-- Submit Form Button -->
                {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-5">
        <h3 style="color: #3c8dbc"><b>Roles</b></h3>
    </div>
    <div class="col-md-7 page-action text-right">
        @can('add_roles')
        <a href="#" class="btn btn-sm btn-success pull-right" data-toggle="modal" data-target="#roleModal"> <i class="glyphicon glyphicon-plus"></i> New</a>
        @endcan
    </div>
</div>
@forelse ($roles as $role)
    {!! Form::model($role, ['method' => 'PUT', 'url' => ['admin/roles',  $role->id ], 'class' => 'm-b']) !!}

    @if($role->name === 'Admin')
        @include('shared._permissions', [
                      'title' => $role->name .' Permissions',
                      'options' => ['disabled'] ])
      @else
        @include('shared._permissions', [
                      'title' => $role->name .' Permissions',
                      'model' => $role ])
        @can('edit_roles')
        {!! Form::submit('Save', ['class' => 'btn btn-success btn-md','style' =>'margin-left:20px']) !!}

        @endcan
    @endif
    {!! Form::close() !!}

    <h1 class="borderdslinecss"></h1>
@empty
    <p>No Roles defined, please run <code>php artisan db:seed</code> to seed some dummy data.</p>
@endforelse
@endsection