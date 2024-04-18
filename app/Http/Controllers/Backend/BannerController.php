<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Banner\BannerStoreRequest;
use App\Http\Requests\Banner\BannerUpdateRequest;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allBanners = Banner::latest()->get();
        return view('backend.banner.all_banners', compact('allBanners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.banner.add_banner');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerStoreRequest $request)
    {
        $newImage = $request->file('banner_image');

        if($newImage){
            $customImageName = uniqid() . '.' . $newImage->getClientOriginalExtension(); 
        }

        $banner = Banner::create([
            "title"         =>      $request->banner_name,
            "image"         =>      "/uploads/banner/images/" . $customImageName,
            "url"           =>      "https://www." . $request->banner_url,
            "created_at"    =>      now(),
            "updated_at"    =>      now()
        ]);

        if($banner){
            $newImage->move(public_path('/uploads/banner/images'), $customImageName);
            return redirect()->route('admin.banners.index')->with('message', "Banner created successfully.");
        }
        else{
            return back()->with('error', "Banner couldn't be created.Please try again later.");
        }
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
        $banner = Banner::findOrFail($id);
        return view('backend.banner.edit_banner', compact("banner"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerUpdateRequest $request, string $id)
    {
        $banner = Banner::findOrFail($id);

        if($newImage = $request->file('banner_image')){
            $customImageName = uniqid(). '.' . $newImage->getClientOriginalExtension();
            File::delete(public_path($banner->image));
            $newImage->move(public_path('/uploads/banner/images/'), $customImageName);
        }
        else{
            $customImageName = $banner->image;
        }

        $banner->title          =       $request->banner_name;
        $banner->image          =       $newImage ? '/uploads/banner/images/' . $customImageName : $customImageName;
        $banner->url    =       $request->banner_url;

        if($banner->update()){
            return redirect()->route('admin.banners.index')->with('message', 'Banner updated successfully');
        }
        else{
            return back()->with('error',"<Banner></Banner> couldn't be updated.Please try again later.");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deletedBanner = Banner::findOrFail($id);

        if($deletedBanner){
            File::delete(public_path($deletedBanner->image));
        }

        if($deletedBanner->delete()){
            return redirect()->back()->with('message', 'Banner deleted successfully');
        }
        else{
            return back()->with('error', "Banner couldn't be deleted.Please try again later.");
        }
    }
}
