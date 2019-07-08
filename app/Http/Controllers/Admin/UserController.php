<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Admin;
use App\Role;
use App\Permission;
use App\Authorizable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use Authorizable;
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;
        if (!empty($keyword)) {
            $result = Admin::where('name', 'LIKE', "%$keyword%")
                ->orWhere('email', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $result = Admin::latest()->paginate($perPage);
        }

        return view('admin.user.index', compact('result'));
    }

    public function create()
    {
        $roles = Role::where('name','!=','Admin')->get();
        return view('admin.user.new', compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'bail|required|min:2',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'roles' => 'required|min:1'
        ]);

        $request->merge(['password' => bcrypt($request->get('password'))]);
        if ( $user = Admin::create($request->except('roles', 'permissions')) ) {

            $this->syncPermissions($request, $user);
            $id=$user->id;
            $url = URL::signedRoute('admin.verification.verify',['id' => $id], now()->addMinutes(30));
            $data['link'] = $url;
            $data['to_email'] = $user->email;
            $data['from_email'] = 'admin@admin.in';
            $data['subject']='Reset password.';
            $data['title']='Verified your email';
            $data['view']='admin.email.resendverificationmail';
            $this->sendemail($data);
            return redirect('admin/users')->with('flash_message','User has been created.');

        } else {
            return redirect('admin/users')->with('error_message','Unable to create user.');

        }

    }

    public function show($id)
    {
        $user_list = Admin::find($id);
        return view('admin.user.show', compact('user_list'));
    }

    public function edit($id)
    {
        $user = Admin::find($id);
        $roles = Role::where('name','!=','Admin')->get();
        $rol = Role::where('name','!=','Admin')->pluck('name', 'id');
        $permissions = Permission::all('name', 'id');

        return view('admin.user.edit', compact('user', 'roles', 'permissions','rol'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'bail|required|min:2',
            'email' => 'required|email|unique:users,email,' . $id,
            'roles' => 'required|min:1'
        ]);

        $user = Admin::findOrFail($id);
        $user->fill($request->except('roles', 'permissions', 'password'));

        if($request->get('password')) {
            $user->password = bcrypt($request->get('password'));
        }
        $this->syncPermissions($request, $user);
        $user->save();
        return redirect('admin/users')->with('flash_message','User has been updated.');
    }
    public function destroy($id)
    {

        if ( Auth::guard('admin')->user()->id == $id) {
            return redirect()->back()->with('error_message', 'Deletion of currently logged in user is not allowed :');
        }

        if( Admin::findOrFail($id)->delete() ) {
            return redirect('admin/users')->with('flash_message', 'User delete successfully');
        } else {
            return redirect('admin/users')->with('error_message', 'User not deleted. Try again !');
        }
    }

    private function syncPermissions(Request $request, $user)
    {
        // Get the submitted roles
        $roles = $request->get('roles', []);
        $permissions = $request->get('permissions', []);

        // Get the roles
        $roles = Role::find($roles);

        // check for current role changes
        if( ! $user->hasAllRoles( $roles ) ) {
            // reset all direct permissions for user
            $user->permissions()->sync([]);
        } else {
            // handle permissions
            $user->syncPermissions($permissions);
        }

        $user->syncRoles($roles);

        return $user;
    }
}
