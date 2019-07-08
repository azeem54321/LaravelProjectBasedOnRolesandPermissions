@extends('admin.layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">User detail {{ $user_list->id }}</div>
                    <div class="panel-body">

                        <a href="{{ url('/admin/users') }}" title="Back">
                            <button class="btn btn-warning btn-xs"><i class="material-icons">arrow_back</i>
                                Back
                            </button>
                        </a>
                        @can('edit_users')
                        <a href="{{ url('/admin/users/' . $user_list->id . '/edit') }}" title="Edit User_list">
                            <button class="btn btn-primary btn-xs"><i class="material-icons">mode_edit</i> Edit
                            </button>
                        </a>
                        @endcan
                        @can('delete_roles')
                        <form method="POST" action="{{ url('/admin/users' . '/' . $user_list->id) }}"
                              accept-charset="UTF-8" style="display:inline">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button type="submit" class="btn btn-danger btn-xs" title="Delete User_list"
                                    onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="material-icons">delete</i>
                                Delete
                            </button>
                        </form>
                        @endcan
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered" id="data-table">
                                <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $user_list->id }}</td>
                                </tr>
                                <tr>
                                    <th> Name</th>
                                    <td> {{ $user_list->name }} </td>
                                </tr>
                                <tr>
                                    <th> Email</th>
                                    <td> {{ $user_list->email }} </td>
                                </tr>
                                <tr>
                                    <th> Role</th>
                                    <td>{{ $user_list->roles->implode('name', ', ') }}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection