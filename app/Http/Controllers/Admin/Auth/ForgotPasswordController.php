<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;

class ForgotPasswordController extends Controller
{


    use SendsPasswordResetEmails;

    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showLinkRequestForm(){
        return view('admin.auth.passwords.email');
    }
    public function sendResetLinkEmail(Request $request){
        $this->validate($request, [
            'email' => 'required|exists:admins'
        ]);
        $data =$request->all();
        $url = URL::route('admin.password.reset',['token' => $data['_token']]);

        $token = DB::table('admin_password_resets')
            ->where('email','=',$data['email'])
            ->first();
         if(!$token){
               DB::table('admin_password_resets')->insert([
                   'email' => $data['email'], 'token' => bcrypt($data['_token']),'created_at'=>date('Y-m-d H:i:s')
            ]);
         }
        else{
            DB::table('admin_password_resets')
                ->where('email', $data['email'])->update([
                'email' => $data['email'], 'token' => bcrypt($data['_token']),'created_at'=>date('Y-m-d H:i:s')
            ]);
        }
        $data['link'] = $url;
        $data['to_email'] = $request['email'];
        $data['from_email'] = 'admin@admin.in';
        $data['subject']='Reset password.';
        $data['title']='Reset password';
        $data['view']='admin.email.resetpassword';
        $mailstatus=$this->sendemail($data);
        if($mailstatus==1) {
            return redirect()->back()->with('status', 'Password Reset Link Send Successfully !');
        }
        else{
            return redirect()->back()->with('status','Some thing wrong! . Please try again!');
        }

    }
}
