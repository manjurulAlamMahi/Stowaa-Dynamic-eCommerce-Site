<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Models\order;
use App\Models\cart;
use App\Models\billingDetail;
use App\Models\orderDetail;
use App\Models\inventory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\invoiceSend;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        return view('stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => 100 * $request->total,
                "currency" => "BDT",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
        ]);

        Session::flash('success', 'Payment successful!');

        // ORDER DATA INSERT

        $data = session('data');


        // Orders Insert
        $order_id = order::insertGetId([
            'customer_id' => Auth::guard('customer')->id(),
            'subtotal' => $data['subtotal'],
            'discount' => $data['discount'],
            'charge' => $data['delivery_charge'],
            'total_price' => $data['total_price'],
            'created_at' => Carbon::now(),
        ]);
        // Billing Details Insert
        billingDetail::insert([
            'order_id' => $order_id,
            'customer_id' => Auth::guard('customer')->id(),
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'number' => $data['number'],
            'note' => $data['note'],
            'district' => $data['district'],
            'upazila' => $data['upazila'],
            'company' => $data['company'],
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
                'payment_method' => $data['payment_method'],
                'created_at' => Carbon::now(),
            ]);

            inventory::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id)->decrement('quantity', $cart->quantity);
        }
        ############################################
        // SMS SEND
        ############################################
        // $url = "http://66.45.237.70/api.php";
        // $number= $data['number'];
        // $text="Hello ". $data['name'] . ", Thanks for purchasing our product. Your Total Amont Is :" . $data['total_price'] . "TAKA";
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
        Mail::to($data['email'])->send(new invoiceSend($order_id));

        cart::where('customer_id', Auth::guard('customer')->id())->delete();

        return redirect()->route('order_success');
    }
}
