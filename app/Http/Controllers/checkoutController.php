<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\cart;
use App\Models\district;
use App\Models\upazila;
use Illuminate\Support\Facades\Auth;

class checkoutController extends Controller
{
    function checkout()
    {
        $districts = district::all();
        $cart = cart::where('customer_id',Auth::guard('customer')->id())->get();
        $subtotal = 0;

        foreach($cart as $carts){
            $subtotal += $carts->rel_to_product->discount_price * $carts->quantity;
        }

        return view('frontend.checkout',[
            'subtotal' => $subtotal,
            'districts' => $districts,
        ]);
    }

    function get_city_id(Request $request)
    {
        $upazilas = upazila::where('district_id' , $request->city_id)->get();
        $str = '<option value="">Select a City</option>';

        foreach($upazilas as $upazila){
            $str .= '<option value="'.$upazila->id.'">'.$upazila->name.'</option>';
        }

        echo $str;

    }
}
