<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin_auth');
    }

    public function index()
    {
        return view('admin.home');
    }

    public function profile()
    {
        return view('admin.profile');
    }

    public function saveprofile(Request $request)
    {
        $user_list = Auth::guard('admin')->user();

        if ($request['password'] == null && $request['password_confirmation'] == null && $request['old_password'] == null) {
            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:admins,email,' . $user_list->id,
            ]);
        } else {
            if (!Hash::check($request['old_password'], $user_list->password)) {
                return redirect()->back()->with('error_password', 'Old Password not Match from Database!');
            }

            $this->validate($request, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:admins,email,' . $user_list->id,
                'password' => 'required|string|min:6|confirmed|different:old_password',
                'old_password' => 'required|string|min:6'
            ]);
        }
        $data = $request->all();

        if ($request['password'] == null && $request['password_confirmation'] == null && $request['old_password'] == null) {
            if ($request->hasFile('image')) {
                $filename = $this->getFileName($request->image);
                $request->image->move(base_path('public/images/profile_image'), $filename);

                $user_list->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'image' => $filename
                ]);
            } else {
                $user_list->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                ]);
            }

        } else {

            if ($request->hasFile('image')) {
                $filename = $this->getFileName($request->image);
                $request->image->move(base_path('public/images/profile_image'), $filename);

                $user_list->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    'image' => $filename
                ]);

            } else {
                $user_list->update([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password'])
                ]);
            }
        }
        return redirect('/admin/profile')->with('flash_message', 'Profile updated Successfully!');
    }

    protected function getFileName($file)
    {
        return str_random(32) . '.' . $file->extension();
    }


}
