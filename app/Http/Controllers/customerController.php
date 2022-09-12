<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\customerUser;
use App\Models\customerEmailVerify;
use App\Notifications\emailVerifyNotification;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;

class customerController extends Controller
{
    function register_login()
    {
        return view('frontend.register');
    }

    function customer_register(Request $request)
    {
        $request->validate([
            'username' => "required",
            'email' => "required",
            'password' => "required",
        ],
        [
            'username.required' => 'Please Enter Name!',
            'email.required' => 'Please Enter Email!',
            'password.required' => 'Please Enter Password!',
        ]
        );

        $customer_id = customerUser::insertGetId([
            'name' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'created_at' => Carbon::now(),
        ]);

        $email_verify = customerEmailVerify::create([
            'customer_id' => $customer_id,
            'token' => uniqid(),
            'created_at' => Carbon::now(),
        ]);

        $mail = customerUser::where('email',$request->email)->firstOrfail();

        Notification::send($mail, new emailVerifyNotification($email_verify));

        return back()->with('email',$request->email);
    }
}
