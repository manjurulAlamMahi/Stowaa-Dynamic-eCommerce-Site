<?php

namespace App\Http\Controllers;

use App\Models\coupon;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;

class couponController extends Controller
{
    function view_coupon()
    {
        $coupons = coupon::all();
        return view('admin.coupon.couponList',[
            'coupons' => $coupons,
        ]);
    }
    function add_coupon()
    {
        return view('admin.coupon.couponadd');
    }

    function coupon_store(Request $request)
    {
        coupon::insert([
            'coupon_name' => $request->coupon_name,
            'coupon_type' => $request->coupon_type,
            'coupon_amount' => $request->discount,
            'coupon_validity' => $request->validity,
            'min_price' => $request->minimum_price,
            'created_at' => Carbon::now(),
        ]);

        return back();
    }
    function coupon_status($coupon_id)
    {
        $coupon = coupon::find($coupon_id);

        if($coupon->status == 0){
            coupon::find($coupon_id)->update([
                'status' => 1,
            ]);
            return back();
        }
        else{
            coupon::find($coupon_id)->update([
                'status' => 0,
            ]);
            return back();
        }
    }
    function coupon_delete($coupon_id)
    {
        coupon::find($coupon_id)->delete();
        return back();
    }
}
