<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class customerLoginController extends Controller
{
    function customer_login(Request $request)
    {
        $data =  $request->all();

        if(Auth::guard('customer')->attempt(['email' => $data['email'] , 'password' => $data['password']]))
        {
            return redirect('/');
        }
        else
        {
            return redirect('/customer/register/signin')->with('login_error', 'Incorrect Email or Passwarod !');
        }
    }

    function customer_logout()
    {
        Auth::guard('customer')->logout();
        return redirect('/customer/register/signin');
    }
}
