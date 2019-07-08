<style>
    input[type="checkbox"]{
        width: 15px; /*Desired width*/
        height: 15px; /*Desired height*/
    }
    [type="checkbox"]:not(:checked), [type="checkbox"]:checked {
        position: inherit !important;
        left: -9999px;
        opacity: 1;
        cursor: pointer;
    }

</style>
<div class="card my-3">
    <div class="card-header" role="tab" id="{{ isset($title) ? str_slug($title) :  'permissionHeading' }}" style="background: lightgray;height:32px">
        <h4 class="mb-0">
            <a role="button" data-toggle="collapse" href="#dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}" aria-expanded="{{ isset($closed) ? 'true' : 'false' }}" aria-controls="dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}" style="color:black">
                {{ $title ?? 'Override Permissions' }} {!! isset($user) ? '<span class="text-danger">(' . $user->getDirectPermissions()->count() . ')</span>' : '' !!}
            </a>
        </h4>
    </div>
    <div id="dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}" class="card-collapse collapse {{ $closed ?? 'in' }}" role="tabcard" aria-labelledby="dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
        <div class="card-body">
            <div class="">
            <div class="row" style="margin-left: 7px !important;">
                @foreach($permissions as $perm)
                    <?php
                    $per_found = null;

                    if( isset($role) ) {
                        $per_found = $role->hasPermissionTo($perm->name);
                    }

                    if( isset($user)) {
                        $per_found = $user->hasDirectPermission($perm->name);
                    }
                    ?>
                    <div class="col-md-3">
                        <div class="checkbox">
                            <?php
                            if(str_contains($perm->name, 'delete')){
                                $rolescolors='text-danger';
                            }
                            elseif(str_contains($perm->name, 'add')){
                                $rolescolors='text-success';
                            }
                            elseif(str_contains($perm->name, 'view')){
                                $rolescolors='text-info';
                            }
                            elseif(str_contains($perm->name, 'edit')){
                                $rolescolors='text-warning';
                            }
                            else{
                                $rolescolors='text-default';
                            }
                            ?>
                            <label class="{{ $rolescolors }}">
                                {!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : []) !!} {{ ucwords(str_replace('_',' ',$perm->name)) }}
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
