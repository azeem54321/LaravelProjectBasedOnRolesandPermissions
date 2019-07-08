<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Admin;


class VerificationController extends Controller
{

    use VerifiesEmails;

    protected $redirectTo = '/admin/home';

    public function __construct()
    {
        $this->middleware('admin_auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }
    public function show(){

        return view('admin.auth.verify');
    }

    public function resend(){
        $user=Auth::guard('admin')->user();
        $id=$user->id;
        $url = URL::signedRoute('admin.verification.verify',['id' => $id], now()->addMinutes(30));
        $data['link'] = $url;
        $data['to_email'] = $user->email;
        $data['from_email'] = 'admin@admin.in';
        $data['subject']='Admin Verify Email.';
        $data['title']='Admin Mail Verification';
        $data['view']='admin.email.resendverificationmail';
        $mailstatus=$this->sendemail($data);
        //Emailsend::dispatch($data);
        if($mailstatus==1){
            return redirect()->back()->with('resent','A fresh verification link has been sent to your email address');
        }
        else{
            return redirect()->back()->with('resent','Some thing wrong! . Please resend the email.');
        }

    }
    public function verify(Request $request,$id){
            $admin=Admin::find($id);
            $admin->email_verified_at=date('Y-m-d H:i:s');
            $admin->save();
            return redirect('/admin/home');

    }
}
