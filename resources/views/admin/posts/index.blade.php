@extends('admin.layouts.master')
<style>
    .searchBar {
        margin-right: 22px !important;
    }
</style>
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header" style="background: #e2d1d1">
                        <h2>
                            Posts
                        </h2>
                    </div>
                    <br>
                    <a href="{{ url('/admin/posts/create') }}" class="btn btn-success btn-sm waves-effect"
                       title="Add New Post" style="margin-left: 22px;">
                        <i class="material-icons">add_circle</i> Add New
                    </a>
                    {!! Form::open(['method' => 'GET', 'url' => '/admin/posts', 'class' => 'navbar-form navbar-right searchBar', 'role' => 'search'])  !!}
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
                    <div class="body">
                        <br>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    @can('view_posts','edit_posts', 'delete_posts')
                                    <th class="text-center">Actions</th>
                                    @endcan
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $key => $item)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td width="800px">{!! $item->description !!}</td>
                                        <td>{{ $item->status==1?'Active':'Disabled' }}</td>
                                        @can('view_posts')
                                        <td class="text-center">
                                            <a href="{{ url('/admin/posts/' . $item->id) }}" title="View Post">
                                                <button class="btn btn-info btn-xs"><i class="material-icons">remove_red_eye</i>
                                                    View
                                                </button>
                                            </a>
                                            @include('shared._actions', ['entity' => 'posts',
                                            'id' => $item->id
                                            ])
                                        </td>
                                        @endcan
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $posts->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
