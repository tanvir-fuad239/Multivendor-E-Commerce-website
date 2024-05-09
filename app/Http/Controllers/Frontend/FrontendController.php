<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\HeroSlider;
use App\Models\Banner;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductTag;
class FrontendController extends Controller
{
    // home page 
    public function index(){

        $showCategoryButton     =       true;
        $heroSliders            =       HeroSlider::select(['title','image'])->oldest()->take(2)->get();

        $featuredCategories     =       Category::query()
                                        ->with(['products' => function ($query){
                                            $query->where("status", 1);
                                        }])
                                        ->latest()
                                        ->get();

 

        $featuredProducts       =       Product::query()
                                        ->where('featured', 1)
                                        ->latest()
                                        ->get();

        
        return view('frontend.index', compact('showCategoryButton', 'heroSliders','featuredCategories','featuredProducts'));

    }

    public function getAllCategories(){
        $totalCategories        =       Category::count();
        $categoriesLeft         =       Category::latest()->take(5)->get();
        $categoriesRight        =       Category::latest()->skip(5)->take(5)->get();

        return response()->json([
            'total'             =>      $totalCategories,
            'left'              =>      $categoriesLeft,
            'right'             =>      $categoriesRight
        ]);
        
    }
    
    public function getAllBanners(){
        $banners = Banner::oldest()->take(3)->get();
        return response()->json(['banner' => $banners]);
    }

    public function getFoodCategories(){

        $foodCategories         =       Category::with(['subcategories' => function($query){
                                            $query->with(['products' => function($query){
                                                $query->where('status', 1)
                                                ->latest()
                                                ->take(5)
                                                ->with('user');
                                            }]);
                                        }])
                                        ->where('category_name', 'Food')
                                        ->firstOrFail();

 


        return response()->json(['foodCategories' => $foodCategories]);
    }

    public function displayCategoriesWithProducts(){

        $categories             =       Category::latest()->take(7)->get();
    
        $categoriesWithProducts =       $categories->map(function ($category) {
                                            $category->products = $category->products()
                                                ->where('status', 1)
                                                ->latest()
                                                ->take(10)
                                                ->with('user:id,name')
                                                ->get();
                                            return $category;
                                        });
    
        return response()->json(['categoriesWithProducts' => $categoriesWithProducts]);
    }
    
    public function getAllHotProducts(){

        $categories             =       ['hot_deals', 'special_offer', 'featured', 'special_deals'];
        $result                 =       [];
        
        foreach ($categories as $category) {
            $result[$category]  =       Product::where($category, 1)
                                        ->where('status', 1)
                                        ->latest()
                                        ->take(3)
                                        ->get(['id','product_name','product_price','discount_price','product_image']);
        }
    
        return $result;

    }

    public function relatedProduct(string $product_id, $category_id){
        
        $relatedProducts        =       Category::query()
                                        ->with(['products' => function($query) use($product_id){
                                            $query->where('id', '!=', $product_id)
                                                  ->where('status', 1)
                                                  ->latest()
                                                  ->take(4);
                                        }])
                                        ->where('id', $category_id)
                                        ->firstOrFail(); 
        return response()->json([
            'relatedProducts' => $relatedProducts
        ]);   
    }

    // display all category 
    public function categoryList(){

        $showCategoryButton     =        false;
        $pageTitle              =        "All Categories";
        $allCategories          =        Category::with(['products' => function ($query){
                                            $query->where("status", 1)->get();
                                        }])
                                        ->latest()
                                        ->get();

        return view('frontend.category_list', compact('pageTitle', 'allCategories', 'showCategoryButton'));
    }

    // display all products of a specific category
    public function productList($category_id){

        $showCategoryButton     =       false;

        $categoryWithProduct    =       Category::with(['products' => function ($query){
                                            $query->where('status', 1)->get();
                                        }])
                                        ->where('id', $category_id)
                                        ->first();

        $restCategories         =       Category::with('products')->where('id', '!=', $category_id)
                                        ->latest()
                                        ->get()
                                        ->take(6);
        
       
        return view('frontend.product_list', compact('categoryWithProduct', 'restCategories', 'showCategoryButton'));

    }

    // vendor details
    public function vendorDetails(){

        $showCategoryButton = false; 

        return view('frontend.vendor_details', compact('showCategoryButton'));
    }

    // product details
    public function productDetails(string $product_id){

        $showCategoryButton = false;
        $product  = Product::findOrFail($product_id);
 
        
        return view('frontend.product_details', compact('showCategoryButton','product'));

    }

    // add to cart 
    public function addToCart($productId){
        
        try{
            $product =  Product::findOrFail($productId); 
            $cart    =  session()->get('cart', []);
    
            if(isset($cart[$productId])){
                $cart[$productId]['quantity']++;
            }
    
            else{
                $cart[$productId] = [
                    'id'        =>      $productId,
                    'category'  =>      $product->category->category_name,
                    'name'      =>      $product->product_name,
                    'price'     =>      $product->discount_price,
                    'quantity'  =>      1,
                    'image'     =>      $product->product_image
                ] ;
            }
    
            session()->put('cart', $cart);

            $productCount = array_sum(array_column($cart, 'quantity'));
            
            return response()->json([
                'count'     =>      $productCount,
                'success'   =>      'Product added to cart successfully.'
            ]);
        }
        catch(\Exception $e){
            return response()->json('error', 'Product failed to add to the cart.');
        }
       
    }

    // view cart 
    public function viewCart(){
        
        $showCategoryButton = false;

        $cart               =   session()->get('cart', []);
        $totalProducts      =   array_sum(array_column($cart, 'quantity'));
        $subTotal           =   0;
        $shippingCharge     =   350;

        foreach($cart as $item){
            $subTotal       +=  $item['price'] * $item['quantity'];
        }

        return view('frontend.view_cart', compact('showCategoryButton','cart','totalProducts','subTotal','shippingCharge'));

    }

    // clear the cart 
    public function clearCart(){
        session()->forget('cart');
        return back()->with('message', 'Your cart has been cleared.');
    }

    // remove product from cart
    public function removeProductFromCart($productId){

        $cart = session()->get('cart');

        if(isset($cart[$productId])){
            unset($cart[$productId]);
        }

        session()->put('cart', $cart);

        $subTotal           =       0;
        $shippingCharge     =       350;

        foreach($cart as $item){
            $subTotal       +=      $item['price'] * $item['quantity'];
        }

        $total              =       $subTotal + $shippingCharge;

        return response()->json([
            'success'           =>      'Product has been removed.',
            'count'             =>      array_sum(array_column($cart, 'quantity')),
            'subTotal'          =>      $subTotal,
            'total'             =>      $total
        ]);
    }

    // cart product increase
    public function productIncrese($productId){
        
        $cart = session()->get('cart');

        if(isset($cart[$productId])){
            $cart[$productId]['quantity']++;
            session()->put('cart', $cart);

        }

        return back()->with('message', 'Product has been increased');

    }

    // cart product decrease
    public function productDecrese($productId){
    
        $cart = session()->get('cart');

        if(isset($cart[$productId])){
            if($cart[$productId]['quantity'] <= 1){
                unset($cart[$productId]);
            }
            else{
                $cart[$productId]['quantity']--;
            }

            session()->put('cart', $cart);
        }

        return back()->with('message', 'Product has been decreased');

    }
}
