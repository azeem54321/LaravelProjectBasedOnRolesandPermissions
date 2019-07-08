@extends('admin.layouts.master')
@section('content')
    <div class="container">
        <div class="row">
                 <div class="col-md-10">
                <div class="card">
                 <div class="header" style="background: #e2d1d1">
                                        <h2>
                                            Post  {{ $post->id }}
                                        </h2>
                                    </div>
                    <div class="body">
                        <a href="{{ url('/admin/posts') }}" title="Back"><button class="btn btn-warning btn-sm"><i class="material-icons">arrow_back</i> Back</button></a>
                        @can('edit_posts', 'delete_posts')
                         <a href="{{ url('/admin/posts/' . $post->id . '/edit') }}" title="Edit Post"><button class="btn btn-primary btn-sm"><i class="material-icons">mode_edit</i> Edit</button></a>
                         <form method="POST" action="{{ url('admin/posts' . '/' . $post->id) }}" accept-charset="UTF-8" style="display:inline">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Post" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="material-icons">delete</i> Delete</button>
                         </form>
                        @endcan
                        <br/>
                        <br/>
                        <div class="table-responsive">
                         <table class="table table-bordered table-striped table-hover">
                                <tbody>
                                    <tr>
                                        <th>ID</th><td>{{ $post->id }}</td>
                                    </tr>
                                    <tr><th> Title </th><td> {{ $post->title }} </td></tr><tr><th> Description </th><td> {{ $post->description }} </td></tr><tr><th> Status </th><td> {{ $post->status }} </td></tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
