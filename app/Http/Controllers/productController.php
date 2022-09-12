<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\subcategory;
use App\Models\category;
use App\Models\product;
use App\Models\thumbnail;
use Illuminate\Support\Str;
use Image;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rules\Unique;

class productController extends Controller
{
    function index()
    {
        $categories = category::all();
        $subcategories = subcategory::all();
        return view('admin.product.index', [
            'categories' => $categories,
            'subcategories' => $subcategories,
        ]);
    }

    function getsubcategory(Request $request)
    {
        $subcategories = subcategory::where('category_id', $request->category_id)->get();
        $str = '<option>-- Select Sub-Category --</option>';
        foreach($subcategories as $subcategory){
            $str.= '<option value="'. $subcategory->id .'">'. $subcategory->subcategory_name .'</option>';
        }
        echo $str;
    }

    function insert_product(Request $request)
    {

        $request->validate([
            'category_name' => "required|unique:categories",
            'subcategory_name' => "required|unique:subcategories",
            'product_name' => "required",
            'product_price' => "required",
            'short_desp' => "required",
        ]);

        $categories = category::find($request->category_name);
        $categorie_name = $categories->category_name;

        $category_id = $request->category_name;
        $subcategory_id = $request->subcategory_name;
        $product_name = $request->product_name;
        $product_price = $request->product_price;
        $product_discount = $request->product_discount;
        $short_desp = $request->short_desp;
        $long_desp = $request->long_desp;


        $product_id = product::insertGetId([

            'category_id' => $category_id,
            'subcategory_id' => $subcategory_id,
            'product_name' => $product_name,
            'product_price' => $product_price,
            'product_discount' => $product_discount,
            'discount_price' => $product_price -  $product_price * ( $product_discount / 100 ),
            'short_desp' => $short_desp,
            'long_desp' => $long_desp,
            'sku' => substr($product_name, 0, 4) . '-' . Uniqid(),
            'slug' => Str::lower($categorie_name) . '-' . str_replace(' ', '-', Str::lower($product_name)). rand(0, 100),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

        ]);


        $product_preview = $request->product_preview;
        $extension = $product_preview->getClientOriginalExtension();
        $product_preview_name = $product_id. '.' .$extension;

        Image::make($product_preview)->resize(680,680)->save(public_path('/uploads/products/previews/'.$product_preview_name));

        product::find($product_id)->update([
            'product_preview' => $product_preview_name,
        ]);


        $sl = 1;
        $thumbnails_images = $request->thumbnails;

        foreach($thumbnails_images as $thumbnails)
        {
            $extension = $thumbnails->getClientOriginalExtension();
            $thumbnail_name = $product_id . '-' . $sl++ . '.' . $extension;

            Image::make($thumbnails)->resize(680,680)->save(public_path('/uploads/products/thumbnails/'.$thumbnail_name));

            thumbnail::insert([
                'product_id' => $product_id,
                'thumbnail' => $thumbnail_name,
                'created_at' => Carbon::now(),
            ]);

        }

        return back()->with('success', 'Product Added Successfully!');


    }

    function view_product()
    {
        $products = product::all();
        return view('admin.product.viewProduct',[
            'products' => $products,
        ]);
    }
}
