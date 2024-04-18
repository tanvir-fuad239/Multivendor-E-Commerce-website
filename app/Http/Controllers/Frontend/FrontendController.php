<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\HeroSlider;
use App\Models\Banner;

class FrontendController extends Controller
{
    // home page 
    public function index(){

        $showCategoryButton = true;
        
        return view('frontend.index', compact('showCategoryButton'));

    }

    public function getAllCategories(){
        $totalCategories = Category::count();
        $categoriesLeft = Category::latest()->take(5)->get();
        $categoriesRight = Category::latest()->skip(5)->take(5)->get();

        return response()->json([
            'total'     =>  $totalCategories,
            'left'      =>  $categoriesLeft,
            'right'     =>  $categoriesRight
        ]);
        
    }

    public function getAllHeroSliders(){
        $heroSlider = HeroSlider::select(['title','image'])->oldest()->take(2)->get();
        return response()->json(["heroSlider" => $heroSlider]);
    }

    public function getAllBanners(){
        $banners = Banner::oldest()->take(3)->get();
        return response()->json(['banner' => $banners]);
    }

    // display all category 
    public function categoryList(){

        $showCategoryButton = false;
        $pageTitle = "All Categories";
        $allCategories = Category::with(['products' => function ($query){
            $query->where("status", 1)->get();
        }])->latest()->get();

        return view('frontend.category_list', compact('pageTitle', 'allCategories', 'showCategoryButton'));
    }

    // display all products of a specific category
    public function productList($category_id){

        $showCategoryButton = false;

        $categoryWithProduct = Category::with(['products' => function ($query){
            $query->where('status', 1)->get();
        }])->where('id', $category_id)->first();

        $restCategories = Category::with('products')->where('id', '!=', $category_id)->latest()->get()->take(6);
       
        return view('frontend.product_list', compact('categoryWithProduct', 'restCategories', 'showCategoryButton'));

    }

    // vendor details
    public function vendorDetails(){

        $showCategoryButton = false; 

        return view('frontend.vendor_details', compact('showCategoryButton'));
    }
}
