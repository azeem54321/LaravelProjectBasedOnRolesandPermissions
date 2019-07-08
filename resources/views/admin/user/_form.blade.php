<style>
    li.select2-selection__choice {
        color: black !important;
        background-color: lightblue !important;
    }
    #permissionHeading{
        margin-left: 284px;
        padding-bottom: 15px;
    }

    .selected{
        background: darkgreen;
    }


    [type="checkbox"]:not(:checked), [type="checkbox"]:checked {
        opacity: 1;
        cursor: pointer;
    }
.card-header{
    background: none !important;
}

</style>
<label for="name" style="font-size:18px;">{{ 'Name' }}</label>
<div class="form-group">
    <div class="form-line">
        <input class="form-control" name="name" type="text" id="name" value="{{ isset($user->name) ? $user->name : ''}}" >
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<label for="email" style="font-size:18px;">{{ 'Email' }}</label>
<div class="form-group">
    <div class="form-line">
        <input class="form-control" name="email" type="email" id="email" value="{{ isset($user->email) ? $user->email : ''}}" >
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<label for="password" style="font-size:18px;">{{ 'Password' }}</label>
<div class="form-group">
    <div class="form-line">
        <input class="form-control" name="password" type="password" id="password">
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<label for="roles" style="font-size:18px;">{{ 'Roles' }}</label>
<div class="form-group">
    <div class="form-line">
        @if(isset($rol))
            {!! Form::select('roles[]', $rol, isset($user) ? $user->roles->pluck('id')->toArray() : null,  ['class' => 'form-control', 'id' =>'userlistselect', 'multiple']) !!}
        @else
            <select name="roles[]" class="form-control" id="userlistselect" multiple>
                @if(isset($roles) && !empty($roles))
                    @foreach($roles as $key => $value)
                        <option value="{{$value->id}}" {{ (collect(old('roles'))->contains($value->id)) ? 'selected':'' }}>{{$value->name}}</option>
                    @endforeach
                @endif
            </select>
        @endif
        {!! $errors->first('roles', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
@if(isset($user))
    @include('shared._permissions', ['closed' => 'true', 'model' => $user ])
@endif
</div>
<button type="submit" class="btn btn-success btn-lg m-t-15 waves-effect col-md-offset-5" style="font-size: 18px;border: double"><i class="material-icons">create</i>{{ $formMode === 'edit' ? 'Update' : 'Create' }}</button>

@section('scripts')
    <script>
        $(document).ready(function() {
            // $('#userlistselect').select2();
            $('#userlistselect').multiselect({
                includeSelectAllOption: true,
                placeholder : "Select Roles"
            });
        });
    </script>
@endsection