<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Mail;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function sendemail($data){
        try {
            Mail::send($data['view'], ['data' => $data], function ($message) use ($data) {
                $message->from($data['from_email'], $data['title']);
                $message->to($data['to_email'])->subject($data['subject']);
            });
            return 1;
        } catch (\Exception $e) {
            return 0;
        }
    }
}
