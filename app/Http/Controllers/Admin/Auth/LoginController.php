<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected function guard()
    {
        return Auth::guard('admin');
    }
    protected $redirectTo = '/admin/home';
    public function __construct()
    {
        $this->middleware('admin_guest')->except('logout');
    }
    public function showLoginForm(){
        return view('admin.auth.login');
    }

    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|email',
            'password'=>'required',
        ]);

        $remember_me = $request->has('remember') ? true : false;
        $user = Admin::where('email',$request->email)->first();
        if(!$user){
            session()->flash('failed_message','Email Id is not registered with us');
            return redirect('admin/login');
        }else if (!Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $remember_me)){
            session()->flash('failed_message','Incorrect Password');
            return redirect('admin/login');
        }else{
            //dd($user);
            $this->guard()->login($user);
            return redirect($this->redirectTo);
        }
    }
    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();
        return redirect('/admin/login')->with('flash_message', 'Logout Successfully !');
    }
}
