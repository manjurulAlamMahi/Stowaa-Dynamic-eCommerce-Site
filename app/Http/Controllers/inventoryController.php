<?php

namespace App\Http\Controllers;
use App\Models\product;
use App\Models\color;
use App\Models\size;
use App\Models\inventory;
use Faker\Core\Color as CoreColor;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;

class inventoryController extends Controller
{
    function inventory($product_id)
    {
        $products = product::find($product_id);
        $colors = color::all();
        $sizes = size::all();
        $inventories = inventory::where('product_id' , $product_id)->get();
        return view('admin.inventory.showInventory', [
            'products' => $products,
            'colors' => $colors,
            'sizes' => $sizes,
            'inventories' => $inventories,
        ]);
    }
    function add_variation()
    {
        $color = color::all();
        $size = size::all();
        return view('admin.inventory.inventoryVariation',[
            'color' => $color,
            'size' => $size,
        ]);
    }
    function add_color(Request $request)
    {
        $color_name = $request->color_name;
        $color_code = $request->color_code;

        color::insert([
            'color_name' => $color_name,
            'color_code' => $color_code,
            'created_at' => Carbon::now(),
        ]);

        return back();
    }
    function add_size(Request $request)
    {
        $size_name = $request->size_name;

        size::insert([
            'size_name' => $size_name,
            'created_at' => Carbon::now(),
        ]);

        return back();
    }
    function add_inentory(Request $request)
    {
        $prodcut_id = $request->product_id;
        $color_id = $request->color_id;
        $size_id = $request->size_id;
        $quantity = $request->quantity;

        if(inventory::where('product_id' , $prodcut_id)->where('color_id' , $color_id)->where('size_id' , $size_id)->exists())
        {
            foreach($size_id as $size){
                inventory::where('product_id' , $prodcut_id)->where('color_id' , $color_id)->where('size_id' , $size)->increment('quantity' , $quantity);
            }
            return back();
        }
        else
        {
            foreach($size_id as $size){

                inventory::insert([
                    'product_id' => $prodcut_id,
                    'color_id' => $color_id,
                    'size_id' => $size,
                    'quantity' => $quantity,
                    'created_at' => Carbon::now(),
                ]);

            }
            return back();
        }
    }
}
