<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            @if(Auth::guard('admin')->user()->image)
                <img src="{{asset('images/profile_image/'.Auth::guard('admin')->user()->image)}}" width="48" height="48" alt="User" />
                @else
            <img src="{{asset('images/user.png')}}" width="48" height="48" alt="User" />
                @endif
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::guard('admin')->user()->name}}</div>
            <div class="email">{{Auth::guard('admin')->user()->email}}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">

                    <li><a href="{{url('/admin/profile')}}"><i class="material-icons">person</i>Profile</a></li>
                    <li role="seperator" class="divider"></li>
                    <li><a href="{{url('/admin/logout')}}"><i class="material-icons">input</i>Sign Out</a></li>
                    <li role="seperator" class="divider"></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active">
                <a href="{{url('admin/home')}}">
                    <i class="material-icons">home</i>
                    <span>Home</span>
                </a>
            </li>
            @can('view_users')
            <li><a href="{{'/admin/users'}}"><i class="material-icons">person_add</i><span>Users</span></a>
            @endcan
             @can('view_roles')
            <li><a href="{{'/admin/roles'}}"><i class="material-icons">book</i><span>Role</span></a></li>
            @endcan
            @can('view_posts')
            <li class="">
                <a href="{{url('admin/posts')}}">
                    <i class="material-icons">local_post_office</i>
                    <span>Post</span>
                </a>
            </li>
            @endcan

            {{--<li>--}}
                {{--<a href="javascript:void(0);" class="menu-toggle">--}}
                    {{--<i class="material-icons">view_list</i>--}}
                    {{--<span>Tables</span>--}}
                {{--</a>--}}
                {{--<ul class="ml-menu">--}}
                    {{--<li>--}}
                        {{--<a href="#">Normal Tables</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="#">Jquery Datatables</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="#">Editable Tables</a>--}}
                    {{--</li>--}}
                {{--</ul>--}}
            {{--</li>--}}

        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; {{date('Y')}} <a href="javascript:void(0);">AdminBSB - Material Design</a>.
        </div>
    </div>
    <!-- #Footer -->
</aside>