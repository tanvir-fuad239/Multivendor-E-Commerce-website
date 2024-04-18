<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\SubCategory;
use App\Http\Controllers\Backend\ProductController;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $sub_categories = SubCategory::with(['category'])->latest()->get();

        return view('backend.sub_category.all_subcategory', compact('sub_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = DB::table('categories')->orderByDesc('id')->get();
        return view('backend.sub_category.add_subcategory', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        DB::table('sub_categories')->insert([

            "category_id" => $request->category_id,
            "subcategory_name" => $request->subcategory_name,
            "subcategory_slug" => strtolower(str_replace(' ','-', $request->subcategory_name)),
            "created_at" => now()

        ]);

        return redirect()->route('subcategory.all')->with('message', "SubCategory added successfully!");
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

        $sub_category = DB::table("sub_categories")->where('id', $id)->first();

        return view('backend.sub_category.edit_subcategory', compact('sub_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        DB::table('sub_categories')->where('id', $id)->update([

            "subcategory_name" => $request->subcategory_name,
            "subcategory_slug" => strtolower(str_replace(' ','-', $request->subcategory_name)),
            "updated_at" => now()

        ]);

        return redirect()->route('subcategory.all')->with('message', "Subcategory Updated Successfully!");
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subCategory = SubCategory::with(['products'])->find($id);
      
        if(!$subCategory){
            return redirect()->route('subcategory.all')->with('message', "Subcategory couldn't be found.Please try again later.");
        }
       
        $deletdSubCategory = $this->deleteSubCategory($subCategory);

        $deletdSubCategory ? $message = "Subcategory deletd successfully" : $message = "Subcategory couldn't be deleted.Please try again later.";

        return redirect()->route('subcategory.all')->with('message', $message);

    }
}
