<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeroSlider;
use App\Http\Requests\Hero_Slider\SliderStoreRequest;
use App\Http\Requests\Hero_Slider\SliderUpdateRequest;
use Illuminate\Support\Facades\File;

class HeroSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allSliders = HeroSlider::latest()->get();
        return view('backend.hero_slider.all_sliders', compact('allSliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.hero_slider.add_slider');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderStoreRequest $request)
    {
        
        if($slider_image = $request->file('slider_image')){
            $customImageName =  uniqid() . '.' . $slider_image->getClientOriginalExtension();
        }

        $slider = new HeroSlider();

        $slider->title          =       $request->slider_name;
        $slider->image          =       '/uploads/hero_sliders/images/' . $customImageName;
        $slider->description    =       $request->slider_description;

        if($slider->save()){
            $slider_image->move(public_path('/uploads/hero_sliders/images/'), $customImageName);

            return redirect()->route('admin.hero-sliders.index')->with('message', "Hero slider created successfully");
        }

        else{
            return back()->with('error', "Hero slider couldn't be created.Please try again later.");
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
        $slider = HeroSlider::findOrFail($id);
        return view('backend.hero_slider.edit_slider', compact("slider"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SliderUpdateRequest $request, string $id)
    {
        $slider = HeroSlider::findOrFail($id);

        if($newImage = $request->file('slider_image')){
            $customImageName = uniqid(). '.' . $newImage->getClientOriginalExtension();
            File::delete(public_path($slider->image));
            $newImage->move(public_path('/uploads/hero_sliders/images/'), $customImageName);
        }
        else{
            $customImageName = $slider->image;
        }

        $slider->title          =       $request->slider_name;
        $slider->image          =       $newImage ? '/uploads/hero_sliders/images/' . $customImageName : $customImageName;
        $slider->description    =       $request->slider_description;

        if($slider->update()){
            return redirect()->route('admin.hero-sliders.index')->with('message', 'Hero slider updated successfully');
        }
        else{
            return back()->with('error',"Hero slider couldn't be updated.Please try again later.");
        }
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deletedSlider = HeroSlider::findOrFail($id);

        if($deletedSlider){
            File::delete(public_path($deletedSlider->image));
        }

        if($deletedSlider->delete()){
            return redirect()->back()->with('message', 'Slider deleted successfully');
        }
        else{
            return back()->with('error', "Slider couldn't be deleted.Please try again later.");
        }
    }

    // hero slider active inactive toggle
    public function sliderToggle($id){

        $slider = HeroSlider::findOrFail($id);
        $slider->is_active = !$slider->is_active;
        $slider->update();
    
        return response()->json(['status' => $slider->is_active]);
    }
}
