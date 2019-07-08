@can('edit_'.$entity)
<a href="{{ route($entity.'.edit', [str_singular($entity) => $id])  }}"
   title="Edit {{$entity}}">
    <button class="btn btn-primary btn-xs"><i class="material-icons">mode_edit</i>
        Edit
    </button>
</a>
@endcan
@can('delete_'.$entity)
    {!! Form::open( ['method' => 'delete', 'url' => route($entity.'.destroy', ['user' => $id]), 'style' => 'display: inline']) !!}
<button type="submit" class="btn btn-danger btn-xs" title="Delete Post"
        onclick="return confirm('Are yous sure wanted to delete it?')"><i
            class="material-icons">delete</i> Delete
</button>
    {!! Form::close() !!}
@endcan
