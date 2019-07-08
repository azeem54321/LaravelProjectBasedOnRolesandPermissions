<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{

    use ResetsPasswords;

    protected $redirectTo = '/admin/home';

    public function __construct()
    {
        $this->middleware('admin_guest');
    }
    public function broker()
    {
        return Password::broker('admin');
    }


    public function showResetForm(Request $request, $token = null)
    {
        $user = DB::table('admin_password_resets')->get();
        $email='';
        if(isset($user) && $user->isNotEmpty()){
            foreach($user as $use){
                if(Hash::check($token, $use->token)){
                    $email=$use->email;

                }
            }
        }
        return view('admin.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $email]
        );
    }
}
