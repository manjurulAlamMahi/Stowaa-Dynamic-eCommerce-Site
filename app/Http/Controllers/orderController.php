<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\invoiceSend;
use App\Models\order;
use App\Models\billingDetail;
use App\Models\cart;
use App\Models\inventory;
use App\Models\orderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class orderController extends Controller
{
    function order_store(Request $request)
    {
        $payment_method = $request->payment_method;

        // Cash On Delivery If
        if($payment_method == 1){
            // Orders Insert
            $order_id = order::insertGetId([
                'customer_id' => Auth::guard('customer')->id(),
                'subtotal' => $request->subtotal,
                'discount' => $request->discount,
                'charge' => $request->delivery_charge,
                'total_price' => $request->total_price,
                'created_at' => Carbon::now(),
            ]);
            // Billing Details Insert
            billingDetail::insert([
                'order_id' => $order_id,
                'customer_id' => Auth::guard('customer')->id(),
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'number' => $request->number,
                'note' => $request->note,
                'district' => $request->district,
                'upazila' => $request->upazila,
                'company' => $request->company,
                'created_at' => Carbon::now(),
            ]);
            // Order Details Insert
            $carts = cart::where('customer_id', Auth::guard('customer')->id())->get();

            foreach($carts as $cart){
                orderDetail::insert([
                    'order_id' => $order_id,
                    'customer_id' => Auth::guard('customer')->id(),
                    'product_id' => $cart->product_id,
                    'color_id' => $cart->color_id,
                    'size_id' => $cart->size_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->rel_to_product->discount_price,
                    'payment_method' => $request->payment_method,
                    'created_at' => Carbon::now(),
                ]);

                inventory::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->decrement('quantity', $cart->quantity);
            }
            ############################################
            // SMS SEND
            ############################################
            // $url = "http://66.45.237.70/api.php";
            // $number= $request->number;
            // $text="Hello ". $request->name . ", Thanks for purchasing our product. Your Total Amont Is :" . $request->total_price . "TAKA";
            // $data= array(
            //     'username'=>"mahiboo",
            //     'password'=>"7G5BKH3E",
            //     'number'=>"$number",
            //     'message'=>"$text"
            // );

            // $ch = curl_init(); // Initialize cURL
            // curl_setopt($ch, CURLOPT_URL,$url);
            // curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // $smsresult = curl_exec($ch);
            // $p = explode("|",$smsresult);
            // $sendstatus = $p[0];

            ############################################
            // INVOICE SEND
            Mail::to($request->email)->send(new invoiceSend($order_id));

            cart::where('customer_id', Auth::guard('customer')->id())->delete();
            return redirect()->route('order_success');

        }
        // SSL Commerz else If
        else if($payment_method == 2){

            $data = $request->all();
            $total_order = cart::where('customer_id', Auth::guard('customer')->id())->count();

            return view('sslpay',[
                'data' => $data,
                'total_order' => $total_order,
            ]);
        }
        // Stripe Payment
        else{
            $data = $request->all();

            return view('stripe',[
                'data' => $data,
            ]);
        }

        return redirect()->route('order_success')->with('success', $request->name);
    }

    function order_success()
    {
        return view('frontend.orderSuccess');
    }
}
