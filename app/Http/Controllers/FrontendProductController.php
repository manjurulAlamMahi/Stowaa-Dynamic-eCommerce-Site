<?php

namespace App\Http\Controllers;

use App\Models\inventory;
use App\Models\orderDetail;
use Illuminate\Http\Request;
use App\Models\product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Arr;

class FrontendProductController extends Controller
{
    function product_details ($product_slug)
    {
        $product_details = product::where('slug',$product_slug)->get();
        $product_id = $product_details->first()->id;
        $category_id = $product_details->first()->category_id;
        $related_product = product::where('id', '!=', $product_id)->where('category_id', $category_id)->take(4)->get();

        // Review Data
        $order_details = orderDetail::where('customer_id' , Auth::guard('customer')->id())->where('product_id', $product_id);

        $product_review = orderDetail::where('product_id', $product_id)->whereNotNull('review')->get();
        $product_star = orderDetail::where('product_id', $product_id)->whereNotNull('star')->sum('star');

        // Review Data

        $product_color = inventory::where('product_id', $product_id)
            ->selectRaw('color_id, count(*) as total')
            ->groupBy('color_id')
            ->get();

        // Cookie Data

        $all_cookies = Cookie::get('recently_viewed_products');

        if(!$all_cookies){
            $all_cookies = "[]";
        }

        $all_info = json_decode($all_cookies, true);
        $cookie_info = Arr::prepend($all_info,$product_id);
        $item_data = json_encode($cookie_info);

        Cookie::queue('recently_viewed_products', $item_data, 100000);
        if(inventory::where('product_id' , $product_id)->exists()){
            $inventory_check = inventory::where('product_id',$product_id)->groupBy('product_id')
            ->selectRaw('sum(quantity) as sum , product_id')
            ->orderBy('quantity', 'DESC')
            ->get();

            foreach($inventory_check as $invt)
            {
                $total_product = $invt->sum;
            }
        }
        else{
            $total_product = 0;
        }

        return view('frontend.product_details',[
            'product_details' => $product_details,
            'product_color' => $product_color,
            'related_product' => $related_product,
            'order_details' => $order_details,
            'product_review' => $product_review,
            'product_star' => $product_star,
            'total_product' => $total_product,
        ]);
    }

    function get_size(Request $request)
    {
        $sizes = inventory::where('product_id',$request->product_id)->where('color_id',$request->color_id)->get();
        $str = '<option value="" data-display="- Please select -">Choose A Option</option>';

        foreach($sizes as $size)
        {
            $str .= '<option value="'.$size->size_id.'">'.$size->rel_to_size->size_name.'</option>';
        }

        echo $str;
    }

    function review_store(Request $request){

        orderDetail::where('customer_id' , Auth::guard('customer')->id())->where('product_id', $request->product_id)->update([
            'review' => $request->review,
            'star' => $request->rating,
            'updated_at' => Carbon::Now(),
        ]);

        return back()->with('success', "Review Done");
    }
}
