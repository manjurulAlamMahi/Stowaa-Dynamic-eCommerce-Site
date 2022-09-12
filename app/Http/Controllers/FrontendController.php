<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\product;
use App\Models\category;
use App\Models\orderDetail;
use App\Models\inventory;
use Illuminate\Support\Facades\Cookie;

class FrontendController extends Controller
{
    // Index

    function frontend()
    {
        $all_product = product::latest()->take(8)->get();
        $all_categories = category::all();
        $new_arrivals = product::latest()->take(4)->get();
        $best_selling = orderDetail::groupBy('product_id')
        ->selectRaw('sum(quantity) as sum, product_id')
        ->orderBy('quantity', 'DESC')
        ->havingRaw('sum >= 4')
        ->get();


        $all_cookies = Cookie::get('recently_viewed_products');

        if($all_cookies == '')
        {
            $arr_unique = array_unique(json_decode("[]", true));
        }
        else
        {
            $arr_unique = array_unique(json_decode($all_cookies, true));
        }

        $all_recently_view_product = product::find($arr_unique);

        $product_id = $all_product->first()->id;
        $product_review = orderDetail::where('product_id', $product_id)->whereNotNull('review')->get();
        $product_star = orderDetail::where('product_id', $product_id)->whereNotNull('star')->sum('star');

        return view('frontend.index', [
            'all_product' => $all_product,
            'best_selling' => $best_selling,
            'all_categories' => $all_categories,
            'new_arrivals' => $new_arrivals,
            'all_recently_view_product' => $all_recently_view_product,
            'product_review' => $product_review,
            'product_star' => $product_star,
        ]);
    }

    // About US
    function about_us()
    {
        return view('frontend.about_us');
    }

    // Contact Us
    function contact_us()
    {
        return view('frontend.contact_us');
    }

    // 404 Error
    function error_404()
    {
        return view('frontend.error_404');
    }
}
