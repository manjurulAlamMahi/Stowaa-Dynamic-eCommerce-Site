<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\customerUser;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Notifications\emailVerifyNotification;
use Illuminate\Support\Facades\Notification;
use App\Models\customerEmailVerify;

class socialLoginController extends Controller
{
    // GITHUB LOGIN
    function github_redirect(){
        return Socialite::driver('github')->redirect();
    }

    function github_callback(){
        $user = Socialite::driver('github')->user();

        if(customerUser::where('email',$user->getEmail())->exists()){
            if(Auth::guard('customer')->attempt(['email' => $user->getEmail(), 'password' => 'abc@123'])){
                return redirect('/');
            }
        }

        else{
            $customer_id = customerUser::insertGetId([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt('abc@123'),
                'created_at' => Carbon::Now(),
            ]);

            $email_verify = customerEmailVerify::create([
                'customer_id' => $customer_id,
                'token' => uniqid(),
                'created_at' => Carbon::now(),
            ]);

            $mail = customerUser::where('email',$user->getEmail())->firstOrfail();

            Notification::send($mail, new emailVerifyNotification($email_verify));

            if(Auth::guard('customer')->attempt(['email' => $user->getEmail(), 'password' => 'abc@123'])){
                return redirect('/');
            }
        }
    }

    // GITHUB LOGIN

    // GOOGLE LOGIN
    function google_redirect(){
        return Socialite::driver('google')->redirect();
    }

    function google_callback(){
        $user = Socialite::driver('google')->user();

        if(customerUser::where('email',$user->getEmail())->exists()){
            if(Auth::guard('customer')->attempt(['email' => $user->getEmail(), 'password' => 'abc@123'])){
                return redirect('/');
            }
        }

        else{
            $customer_id = customerUser::insertGetId([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => bcrypt('abc@123'),
                'created_at' => Carbon::Now(),
            ]);

            $email_verify = customerEmailVerify::create([
                'customer_id' => $customer_id,
                'token' => uniqid(),
                'created_at' => Carbon::now(),
            ]);

            $mail = customerUser::where('email',$user->getEmail())->firstOrfail();

            Notification::send($mail, new emailVerifyNotification($email_verify));

            if(Auth::guard('customer')->attempt(['email' => $user->getEmail(), 'password' => 'abc@123'])){
                return redirect('/');
            }
        }
    }

    // GOOGLE LOGIN
}
