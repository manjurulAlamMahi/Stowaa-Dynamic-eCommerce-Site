<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cart;
use App\Models\inventory;
use App\Models\coupon;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class cartController extends Controller
{
    function cart_store(Request $request)
    {

        $request->validate([
            'color_id' => "required",
            'size_id' => "required",
            'quantity' => "required",
        ],
        [
            'color_id.required' => 'Please Select Color!',
            'size_id.required' => 'Please Select Size!',
        ]
        );

        if(Auth::guard('customer')->check())
        {
            $product_quantity = inventory::where('product_id',$request->product_id)->where('size_id',$request->size_id)->where('color_id',$request->color_id)->first()->quantity;

            if($product_quantity > $request->quantity)
            {
                if(cart::where('customer_id',Auth::guard('customer')->id())->where('product_id',$request->product_id)->where('size_id',$request->size_id)->where('color_id',$request->color_id)->exists())
                {
                    cart::where('customer_id',Auth::guard('customer')->id())->where('product_id',$request->product_id)->where('size_id',$request->size_id)->where('color_id',$request->color_id)->increment('quantity',$request->quantity);

                    return back();
                }
                else
                {
                    cart::insert([
                        'customer_id' => Auth::guard('customer')->id(),
                        'product_id' => $request->product_id,
                        'size_id' => $request->size_id,
                        'color_id' => $request->color_id,
                        'quantity' => $request->quantity,
                        'created_at' => Carbon::now(),
                    ]);

                    return back();
                }
            }
            else
            {
                return back()->with('stock_out', 'Stock Out !! Try to puchase less product');
            }
        }
        else
        {
            return redirect()->route('register_login')->with('login_error', 'Please Log In Before Adding Product On Cart!!');
        }
    }

    function cart_remove($cart_id)
    {
        cart::where('id',$cart_id)->delete();
        return back()->with('cart_remove', 'item removed successfully');
    }

    function view_cart(Request $request)
    {
        $cart = cart::where('customer_id',Auth::guard('customer')->id())->get();
        $coupon = coupon::where('coupon_name',$request->coupon)->where('status',1);

        $discount = null;
        $type = null;
        $msg = null;
        $subtotal = 0;

        foreach($cart as $cart_sub_total){
            $subtotal += $cart_sub_total->rel_to_product->discount_price * $cart_sub_total->quantity;
        }


        if($request->coupon == "")
        {
            $discount = 0;
        }
        else
        {
                if($coupon->exists())
            {
                if($coupon->first()->coupon_validity > Carbon::today())
                {
                    if($subtotal > $coupon->first()->min_price){
                        $discount = $coupon->first()->coupon_amount;
                        $type = $coupon->first()->coupon_type;
                    }
                    else{
                        $discount = 0;
                        $msg = "Total Purchase Amount Must Be" . $coupon->first()->min_price . "To Use This Coupon !!";
                    }
                }
                else
                {
                    $discount = 0;
                    $msg = "Coupon Code Expired!!";
                }
            }
            else
            {
                $discount = 0;
                $msg = "Invalid Coupon Code!!";
            }
        }



        return view('frontend.cart',[
            'cart' => $cart,
            'discount' => $discount,
            'type' => $type,
            'msg' => $msg,
            'subtotal'=> $subtotal,
        ]);
    }

    function quanity_update(Request $request)
    {
        foreach($request->quantity as $cart_id => $quantity){
            Cart::find($cart_id)->update([
                'quantity' => $quantity,
            ]);
        }
        return back();
    }
}
