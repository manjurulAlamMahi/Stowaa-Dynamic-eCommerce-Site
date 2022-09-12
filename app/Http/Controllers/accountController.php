<?php

namespace App\Http\Controllers;

use App\Models\billingDetail;
use App\Models\customerUser;
use App\Models\order;
use App\Models\orderDetail;
use App\Models\customerPasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\password_reset;
use App\Notifications\passwordResetNotification;
use App\Models\customerEmailVerify;
use App\Notifications\emailVerifyNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Carbon;
use PDF;

class accountController extends Controller
{


    function account()
    {
        $orders = order::where('customer_id', Auth::guard('customer')->id())->get();
        return view('frontend.account',[
            'orders' => $orders,
        ]);
    }

    function invoice_download($order_id)
    {
        $orders = order::where('id', $order_id)->get();
        $billingDetails = billingDetail::where('order_id', $order_id)->get();
        $orderDetail = orderDetail::where('order_id', $order_id)->get();

        // return view('invoice.invoiceDownload',[
        //     'orders' => $orders,
        //     'billingDetails' => $billingDetails,
        //     'orderDetail' => $orderDetail,
        // ]);

        $data = [
            'orders' => $orders,
            'billingDetails' => $billingDetails,
            'orderDetail' => $orderDetail,
        ];

        $pdf = PDF::loadView('invoice.invoiceDownload', $data);
        return $pdf->download('lightinvoice.pdf');

    }

    function forget_pass(){

        return view('frontend.forget_pass');
    }

    function reset_pass_data_store(Request $request){

        $customer = customerUser::where('email',$request->email);

        $mail = $customer->first();

        if($customer->exists()){

            $delete_old_data = customerPasswordReset::where('customer_id',$customer->first()->id)->delete();

            $passoword_reset = customerPasswordReset::create([
                'customer_id' => $customer->first()->id,
                'token' => uniqid(),
                'created_at' => Carbon::now(),
            ]);

            Notification::send($mail, new passwordResetNotification($passoword_reset));

            return back()->with('request', 'Your Requested Is Granted Check Your Email Address!');

        }
        else{
            return back()->with('error', 'Invalid Email!');
        }
    }

    function new_password($token){
        if(customerPasswordReset::where('token',$token)->exists()){
            return view('frontend.new_pass', compact('token'));
        }
        else{
            abort(404);
        }
    }

    function update_new_password(Request $request){
        if($request->new_password == $request->con_password){

            $customer_id = customerPasswordReset::where('token' , $request->token)->first()->customer_id;


            customerUser::where('id',$customer_id)->update([
                'password' => bcrypt($request->new_password),
                'updated_at' => Carbon::now(),
            ]);


            customerPasswordReset::where('customer_id',$customer_id)->delete();

            return view('frontend.register');

        }
        else{
            return back()->with('error', 'Password Not Matched!');
        }
    }

    function email_verfiy($token){
        if(customerEmailVerify::where('token',$token)->exists()){
            $customer_id = customerEmailVerify::where('token',$token)->first()->customer_id;

            customerUser::find($customer_id)->update([
                'email_verify' => Carbon::now(),
            ]);

            customerEmailVerify::where('customer_id',$customer_id)->delete();

            return redirect()->route('frontend');

        }
        else{
            abort(404);
        }
    }
    function email_verfiy_again(){

        $email_verify = customerEmailVerify::where('customer_id',Auth::guard('customer')->user()->id)->first();

        $mail = customerUser::where('email', Auth::guard('customer')->user()->email)->firstOrfail();

        Notification::send($mail, new emailVerifyNotification($email_verify));

        return back()->with('success', 'Link Send Successfully');
    }
}
