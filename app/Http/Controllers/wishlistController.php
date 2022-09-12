<?php

namespace App\Http\Controllers;

use App\Models\wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class wishlistController extends Controller
{
    function wishlist(){

        $wishlists = wishlist::where('customer_id' , Auth::guard('customer')->user()->id)->get();

        return view('frontend.wishlist',[
            'wishlists' => $wishlists,
        ]);
    }

    function favourit($product_id){
        if(Auth::guard('customer')->check()){
            if(wishlist::where('customer_id', Auth::guard('customer')->user()->id)->where('product_id',$product_id)->exists()){
                return back()   ;
            }
            else{
                wishlist::insert([
                    'customer_id' => Auth::guard('customer')->user()->id,
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);
                return back();
            }
        }
        else{
            return redirect()->route('register_login');
        }
    }

    function remove_wishes($wishlist_id){
        wishlist::find($wishlist_id)->delete();
        return back();
    }
}
