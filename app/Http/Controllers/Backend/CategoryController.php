<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //    $categories = Category::latest()->get();
    $categories = DB::table('categories')->orderBy('id','DESC')->get();

    return view('backend.category.all_category', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.category.add_category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category_image = $request->file('category_image');

        if($category_image){
            $custom_image_name = uniqid() . "." . $category_image->getClientOriginalExtension();
            $category_image->move(public_path('uploads/category/images/'), $custom_image_name);
        }
        
        if($request->category_name && !$category_image){
            DB::table('categories')->insert([
                "category_name" => $request->category_name,
                "category_slug" => strtolower(str_replace(' ', '-', $request->category_name)),
                "created_at" => now()
            ]);
        }

        else{
            DB::table('categories')->insert([
                "category_name" => $request->category_name,
                "category_slug" => strtolower(str_replace(' ', '-', $request->category_name)),
                "category_image" => $custom_image_name,
                "created_at" => now()
            ]);
        }


        return redirect()->route('category.all')->with('message', "Category added successfully!");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = DB::table('categories')->where('id', $id)->first();

        return view('backend.category.edit_category', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $new_image = $request->file('category_image');
        $category = DB::table('categories')->where('id', $id)->first();

        if($new_image){

            $custom_image_name = uniqid() . '.' . $new_image->getClientOriginalExtension();
            @unlink(public_path('uploads/category/images/' . $category->category_image));
            $new_image->move(public_path('uploads/category/images/'), $custom_image_name);

        }

        else{

            $custom_image_name = $category->category_image;

        }

        DB::table('categories')->where('id', $id)->update([
            "category_name" => $request->category_name,
            "category_slug" => strtolower(str_replace(' ', '-', $request->category_name)),
            "category_image" => $custom_image_name,
            "updated_at" => now()
        ]);

        return redirect()->route('category.all')->with('message', "Category Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $category = Category::with('subcategories')->find($id);

        if(!$category){
            return back()->with("message", "Category doesn't exists!");
        }

        $deletedSubCategory = $this->deleteCategory($category);

        $deletedSubCategory ? $message = "Category deleted successfully" : $message = "Category couldn't be deleted.Please try again later.";      
 
        return redirect()->route('category.all')->with('message', $message);
        
    }
    
}
