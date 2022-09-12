<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\category;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Contracts\Service\Attribute\Required;
use Image;

class categoriesController extends Controller
{
    // SELECT CATEGORY ALL DATA
    function category()
    {
        $category_list = category::all();
        $category_list_count = category::count();
        $trash_category_list = category::onlyTrashed()->get();
        return view('admin.category.index', compact('category_list', 'trash_category_list', 'category_list_count'));
    }
    function category_list()
    {
        $category_list = category::all();
        $category_list_count = category::count();
        $trash_category_list = category::onlyTrashed()->get();
        return view('admin.category.categoryList', compact('category_list', 'trash_category_list', 'category_list_count'));
    }
    // INSERT CATEGORY DATA
    function category_store(Request $request)
    {
        $icon_type = $request->icon_type;
        $icon_name = $request->icon_name;
        $category_icon = $icon_type." ".$icon_name;

        $request->validate([
            'category_name' => "required|unique:categories",
            'category_img' => "mimes:jpg,png",
            'category_img' => "file|max:512",
        ],
        [
            'category_name.required' => 'Please Enter Category Name!',
            'category_name.unique' => 'Category Name is taken!',
        ]
        );

        if($request->category_img){

            $category_id = category::insertGetId([
                'category_name' => $request->category_name,
                'category_icon' => $category_icon,
                'added_updated_by' => Auth::id(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            $category_img = $request->category_img;
            $extension = $category_img->getClientOriginalExtension();
            $category_img_name = $category_id. '.' .$extension;

            Image::make($category_img)->resize(150,175)->save(public_path('/uploads/category/'.$category_img_name));

            category::find($category_id)->update([
                'category_img' => $category_img_name,
            ]);
            return back()->with('success', 'Category Added Successfully!');
        }

        else{
            category::insert([
                'category_name' => $request->category_name,
                'category_icon' => $category_icon,
                'added_updated_by' => Auth::id(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            return back()->with('success', 'Category Added Successfully!');
        }


    }
    // GET CATEGORY PREVIOUS DATA
    function category_edit($category_id)
    {
        $prv_category = category::find($category_id);
        return view('admin.category.edit', compact('prv_category'));
    }
    // UPDATE CATEGORY PREVIOUS DATA
    function category_update(Request $request)
    {
        $image = category::find($request->category_id);
        $delete_from = public_path('/uploads/category/'.$image->category_img);
        if($request->category_img == "" ){
            category::find($request->category_id)->update([
                'category_name' => $request->category_name,
                'added_updated_by' => Auth::id(),
                'updated_at' => Carbon::now(),
            ]);
            return redirect('/dashboard/categories')->with('success', 'Category Name Updated Successfully!');
        }
        else{
            if($image->category_img == "default.png"){
                $category_img = $request->category_img;
                $extension = $category_img->getClientOriginalExtension();
                $category_img_name = $request->category_id. '.' .$extension;

                Image::make($category_img)->resize(150,175)->save(public_path('/uploads/category/'.$category_img_name));

                category::find($request->category_id)->update([
                    'category_img' => $category_img_name,
                ]);
                return redirect('/dashboard/categories/list')->with('success', 'Category Name Updated Successfully!');
            }
            else{

                unlink($delete_from);

                $category_img = $request->category_img;
                $extension = $category_img->getClientOriginalExtension();
                $category_img_name = $request->category_id. '.' .$extension;

                Image::make($category_img)->resize(150,175)->save(public_path('/uploads/category/'.$category_img_name));

                category::find($request->category_id)->update([
                    'category_img' => $category_img_name,
                ]);
                return redirect('/dashboard/categories/list')->with('success', 'Category Name Updated Successfully!');
            }




        }
    }
    // SOFT DELETE CATEGORY DATA
    function delete_category($category_id)
    {
        category::find($category_id)->delete();
        return back()->with('delete', 'Category Name Deleted Successfully!');
    }
    // RESTORE SOFT DELETE CATEGORY DATA
    function restore_category($category_id)
    {
        category::onlyTrashed()->find($category_id)->restore();
        return back()->with('success', 'Category Name Restored Successfully!');
    }
    // PERMANENT DELETE CATEGORY DATA
    function per_del_category($category_id)
    {
        $image = category::onlyTrashed()->find($category_id);
        $delete_from = public_path('/uploads/category/'.$image->category_img);
        if($image->category_img == "default.png"){
            category::onlyTrashed()->find($category_id)->forceDelete();
            return back()->with('success', 'Category Name Delete Permanently!');
        }
        else{
            unlink($delete_from);
            category::onlyTrashed()->find($category_id)->forceDelete();
            return back()->with('success', 'Category Name Delete Permanently!');
        }

    }
    // DELETE MARKED CATEGORY DATA
    function category_delete_marked(Request $request)
    {
        $request->validate([
            'mark' => 'required',
        ]);
        foreach($request->mark as $mark){
            category::find($mark)->delete();
        }
        return back()->with('delete', 'Marked Category Name Deleted Successfully!');
    }
}

