@extends('admin.layouts.master')
@section('content')
    <div class="panel panel-success">
        <div class="panel-heading">Users</div>
        <div class="panel-body">
            <div class="col-md-12 page-action text-left">
                @can('add_users')
                <a href="{{ url('/admin/users/create') }}" class="btn btn-success btn-sm waves-effect"
                   title="Add New User" style="margin-left: 22px;">
                    <i class="material-icons">add_circle</i> Add New
                </a>
                @endcan
            </div>
            <div class="col-md-12">

                {!! Form::open(['method' => 'GET', 'url' => '/admin/users', 'class' => 'navbar-form navbar-right searchBar', 'role' => 'search'])  !!}
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search..."
                           style="border: ridge">
                             <span class="input-group-btn">
                             <button class="" type="submit">
                                 <i class="material-icons" style="height: 27px !important;">search</i>
                             </button>
                              </span>
                </div>
                {!! Form::close() !!}
            </div>
            <br/>
            <br/>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="data-table">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Created At</th>
                        @can('edit_users', 'delete_users')
                            <th class="text-center">Actions</th>
                        @endcan
                    </tr>
                    </thead>
                        <tbody>

                    @foreach($result as $key => $item)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->roles->implode('name', ', ') }}</td>
                            <td>{{ $item->created_at->toFormattedDateString() }}</td>
                            @can('view_users')
                                <td class="text-center">
                                         <span @if($item->id==1 || $item->name=='Admin') style="display: none" @endif>
                                           <a href="{{ url('/admin/users/' . $item->id) }}" title="View User">
                                               <button class="btn btn-info btn-xs"><i class="material-icons">remove_red_eye</i>
                                                   View
                                               </button>
                                           </a>
                                        @include('shared._actions', [
                                        'entity' => 'users',
                                        'id' => $item->id
                                        ])
                                 </span>
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                        </tbody>
                    </table>
                    <div class="pagination-wrapper"> {!! $result->appends(['search' => Request::get('search')])->render() !!} </div>
                </div>

            </div>
        </div>
    </div>

@endsection