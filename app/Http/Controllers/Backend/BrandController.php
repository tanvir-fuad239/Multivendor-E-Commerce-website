<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       
    //    $brands = Brand::latest()->get();
    $brands = DB::table('brands')->orderBy('id','DESC')->get();

       return view('backend.brand.all_brand', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('backend.brand.add_brand');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $brand_image = $request->file('brand_image');

        if($brand_image){
            $custom_image_name = uniqid() . "." . $brand_image->getClientOriginalExtension();
            $brand_image->move(public_path('uploads/brand/images/'), $custom_image_name);
        }
        
        if($request->brand_name && !$brand_image){
            DB::table('brands')->insert([
                "brand_name" => $request->brand_name,
                "brand_slug" => strtolower(str_replace(' ', '-', $request->brand_name))
            ]);
        }

        else{
            DB::table('brands')->insert([
                "brand_name" => $request->brand_name,
                "brand_slug" => strtolower(str_replace(' ', '-', $request->brand_name)),
                "brand_image" => $custom_image_name,
                "created_at" => now()
            ]);
        }


        return redirect()->route('brand.all')->with('message', "Brand added successfully!");
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
        
        $brand = DB::table('brands')->where('id', $id)->first();

        return view('backend.brand.edit_brand', compact('brand'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $new_image = $request->file('brand_image');
        $brand = DB::table('brands')->where('id', $id)->first();

        if($new_image){

            $custom_image_name = uniqid() . '.' . $new_image->getClientOriginalExtension();
            @unlink(public_path('uploads/brand/images/' . $brand->brand_image));
            $new_image->move(public_path('uploads/brand/images/'), $custom_image_name);

        }

        else{

            $custom_image_name = $brand->brand_image;

        }

        DB::table('brands')->where('id', $id)->update([
            "brand_name" => $request->brand_name,
            "brand_slug" => strtolower(str_replace(' ', '-', $request->brand_name)),
            "brand_image" => $custom_image_name,
            "updated_at" => now()
        ]);

        return redirect()->route('brand.all')->with('message', "Brand Updated Successfully!");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $brand = DB::table('brands')->where('id', $id)->first();
        @unlink(public_path('uploads/brand/images/' . $brand->brand_image));

        DB::table('brands')->where('id', $id)->delete();

        return redirect()->route('brand.all')->with('message', "Brand Deleted Successfully!");
        
    }
}
