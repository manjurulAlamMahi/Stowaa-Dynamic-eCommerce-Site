<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use App\Models\subcategory;
use Illuminate\Validation\Rules\Exists;

class SubcategoryController extends Controller
{
    function index()
    {
        $category_name = category::all();
        $subcategories = subcategory::all();
        return view('admin.subcategory.index',[
            'category_name' => $category_name,
            'subcategories' => $subcategories,
        ]);
    }

    function subcategory_store(Request $request)
    {
        $subcategories = Subcategory::where([['category_id', $request->category_id], ['subcategory_name', $request->subcategory_name]])->exists();

        if($subcategories){
            return redirect('/dashboard/subcategory')->with('error', 'SubCategory Name Already Exist on this Category!');
        }
        else{
            subcategory::insert([
                'category_id' => $request->category_id,
                'subcategory_name' => $request->subcategory_name,
            ]);
            return redirect('/dashboard/subcategory')->with('success', 'Sub Category Name Added Successfully!');
        }
    }
}
