<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\orderDetail;
use Illuminate\Http\Request;
use App\Models\product;
use App\Models\size;
use App\Models\color;

class shopController extends Controller
{

    // MAIN SHOP PAGE ###################
    function shop(Request $request){

        $data = $request->all();

        $all_products = product::where(function($search) use ($data){
            // Search Input Check
            if(!empty($data['q']) && $data['q'] != '' && $data['q'] != "undefined")
            {
                $search->where(function($search) use ($data){
                    $search->where('product_name', 'like', '%'.$data['q'].'%');
                    $search->orWhere('short_desp', 'like', '%'.$data['q'].'%');
                    $search->orWhere('long_desp', 'like', '%'.$data['q'].'%');
                });
            }
            // Search Category Check
            if(!empty($data['c']) && $data['c'] != '' && $data['c'] != "undefined")
            {
                $search->where(function($search) use ($data){
                    $search->where('category_id', $data['c']);
                });
            }
            // Search SubCategory Check
            if(!empty($data['sc']) && $data['sc'] != '' && $data['sc'] != "undefined")
            {
                $search->where(function($search) use ($data){
                    $search->where('subcategory_id', $data['sc']);
                });
            }
            // Search Color & Size Check
            if(!empty($data['clr']) && $data['clr'] != '' && $data['clr'] != "undefined" || !empty($data['sz']) && $data['sz'] != '' && $data['sz'] != "undefined")
            {
                $search->whereHas('rel_to_inventories', function($search) use ($data){
                    // Color Check
                    if(!empty($data['clr']) && $data['clr'] != '' && $data['clr'] != "undefined"){
                        $search->whereHas('rel_to_color', function($search) use ($data){
                            $search->where('colors.id',$data['clr']);
                        });
                    }
                    // Size Check
                    if(!empty($data['sz']) && $data['sz'] != '' && $data['sz'] != "undefined"){
                        $search->whereHas('rel_to_size', function($search) use ($data){
                            $search->where('sizes.id',$data['sz']);
                        });
                    }
                });
            }
            // Price Check
            if(!empty($data['min']) && $data['min'] != '' && $data['min'] != "undefined" || !empty($data['max']) && $data['max'] != '' && $data['max'] != "undefined"){
                $search->whereBetween('discount_price',[$data['min'],$data['max']]);
            }
        });
        // SortBy Check
        if(!empty($data['sb']) && $data['sb'] != '' && $data['sb'] != "undefined"){
            if($data['sb'] == "A_Z"){
                $sort_by_products = $all_products->sortBy('product_name');
            }
            else if($data['sb'] == "Z_A"){
                $sort_by_products = $all_products->sortByDesc('product_name');
            }
            else if($data['sb'] == "H_L"){
                $sort_by_products = $all_products->sortBy('discount_price');
            }
            else if($data['sb'] == "L_H"){
                $sort_by_products = $all_products->sortByDesc('discount_price');
            }
            else{
                $sort_by_products = $all_products;
            }
        }
        else{
            $sort_by_products = $all_products;
        }


        $categories = category::all();
        $sizes = size::all();
        $colors = color::all();


        if($all_products->count() > 0)
        {
            $product_id = $all_products->first()->id;
        }
        else{
            $product_id = 0;
        }


        $product_review = orderDetail::where('product_id', $product_id)->whereNotNull('review')->get();
        $product_star = orderDetail::where('product_id', $product_id)->whereNotNull('star')->sum('star');

        return view('frontend.shop',[
            'all_products' => $sort_by_products->paginate(9),
            'all_products_list' => $sort_by_products->paginate(3),
            'product_review' => $product_review,
            'product_star' => $product_star,
            'categories' => $categories,
            'sizes' => $sizes,
            'colors' => $colors,
        ]);
    }
    // MAIN SHOP PAGE ###################



}
