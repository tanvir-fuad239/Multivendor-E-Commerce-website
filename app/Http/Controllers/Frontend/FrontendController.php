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
use App\Models\Cupon;
use Carbon\Carbon;

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
                    'name'      =>      $product->product_name,
                    'price'     =>      $product->discount_price,
                    'quantity'  =>      1,
                    'image'     =>      $product->product_image
                ] ;
            }
    
            session()->put('cart', $cart);

            $productCount = $this->totalProducts($cart);
            
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
        $totalProducts      =   $this->totalProducts($cart);
        $subTotal           =   $this->subTotal($cart);
        $shippingCharge     =   350;

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

        $subTotal           =       $this->subTotal($cart);
        $totalProducts      =       $this->totalProducts($cart);
        $shippingCharge     =       350;

        $total              =       $subTotal + $shippingCharge;

        return response()->json([
            'success'       =>      'Product has been removed.',
            'count'         =>      $totalProducts,
            'subTotal'      =>      $subTotal,
            'total'         =>      $total
        ]);
    }

    // cart product increase
    public function productIncrese($productId){
        
        $cart = session()->get('cart');

        if(isset($cart[$productId])){
            $cart[$productId]['quantity']++;
            session()->put('cart', $cart);

        }
        
        $totalProducts          =       $this->totalProducts($cart);
        $productQuantity        =       $cart[$productId]['quantity'];
        $productSubTotal        =       $cart[$productId]['quantity'] * $cart[$productId]['price'];
        $subTotal               =       $this->subTotal($cart);
        $shippingCharge         =       350;

        $total                  =       $subTotal + $shippingCharge;
        
        return response()->json([
            'success'           =>      'Product has been increased.',
            'count'             =>      $totalProducts,
            'qty'               =>      $productQuantity,
            'productSubTotal'   =>      $productSubTotal,
            'subTotal'          =>      $subTotal,
            'total'             =>      $total
        ]);

    }

    // cart product decrease
    public function productDecrese($productId){
    
        $cart = session()->get('cart');

        if(isset($cart[$productId])){

            if($cart[$productId]['quantity'] <= 1){
                unset($cart[$productId]);
                $message = "Product has been removed";
            }

            else{
                $cart[$productId]['quantity']--;
                $message = "Product has been decreased";

            }

            session()->put('cart', $cart);

            $totalProducts          =       $this->totalProducts($cart);
            $subTotal               =       $this->subTotal($cart);
            $shippingCharge         =       350;
    
            $total                  =       $subTotal + $shippingCharge;

            $responseData = [
                'success'           =>      $message,
                'count'             =>      $totalProducts,
                'subTotal'          =>      $subTotal,
                'total'             =>      $total,
            ];
    
            if (isset($cart[$productId])) {
                $responseData += [
                    'qty' => $cart[$productId]['quantity'],
                    'productSubTotal' => $cart[$productId]['price'] * $cart[$productId]['quantity'],
                ];
            } 
            
            else {
                $responseData['qty'] = null;
            }
    
            return response()->json($responseData);
         
        }

    }

    // calculate the total products in the cart
    private function totalProducts($cart){
        return array_sum(array_column($cart, 'quantity'));
    }

    // calculate the subtotal of all products
    private function subTotal($cart){

        $subTotal       =   0;

        foreach($cart as $item){
            $subTotal   +=  $item['price'] * $item['quantity'];
        }

        return $subTotal;
    }

    // apply cupon
    public function applyCupon(Request $request){
        
        $cupon              =           Cupon::query()
                                            ->where('code', $request->coupon)
                                            ->where('status',1)
                                            ->first();

        $shippingCharge     =       350;

        // check coupon code is exists to the database
        if(!$cupon){
            return response()->json([
                'error' => 'Invalid Coupon'
            ]);
        }

        $now = Carbon::now();
        $validFrom          =           Carbon::createFromFormat('Y-m-d H:i:s',$cupon->valid_from);
        $expireAt           =           Carbon::createFromFormat('Y-m-d H:i:s',$cupon->expires_at);

        // check the current date is in the range of coupon validation date
        if($now->lt($validFrom)){
            return response()->json([
                'validFrom' => 'Coupon is not valid yet.'
            ]);
        }

        if($now->gt($expireAt)){
            return response()->json([
                'expireAt'  =>  'Coupon has been expired.'
            ]);
        }

        // check the minimum amount to apply cupon discount
        $subTotal           =           $this->subTotal(session()->get('cart', []));
        
        if($subTotal < $cupon->minimum_amount){
            return response()->json([
                'minAmount' =>  'Your minimum order amount is &#2547;' . number_format($cupon->minimum_amount) . ' to apply this coupon.'
            ]);
        }

        if($cupon->type == 'fixed'){
            $discount           =       number_format($cupon->amount);
            $total              =       ($subTotal - $discount) + $shippingCharge;
        }

        else{
            $discount           =       number_format(($cupon->minimum_amount * $cupon->amount)/100);
            $total              =       ($subTotal - $discount) + $shippingCharge;
        }

        return response()->json([
            'success'   =>      'true',
            'discount'  =>      $discount,
            'total'     =>      $total
        ]);
    }
}
