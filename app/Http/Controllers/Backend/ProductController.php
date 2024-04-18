<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\user;
use App\Models\Product;
use App\Models\ProductTag;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Models\multi_imgs;
use App\Services\ProductService;



class ProductController extends Controller
{

    protected $productService;

    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }

    /**
     * Display a listing of the product.
     */
    public function index(Request $request, $key = null)
    {

        // search functionality
        if($request->search){
            $allProducts = $this->serachProduct($request->search);
            return view('backend.product.all_product', compact('allProducts'));
        }

        $getProducts = Product::get(['id','product_name','product_price','discount_price','product_image']);

        $allProducts = $this->productService->indexProduct($getProducts, $key);

        if($allProducts){
            return view('backend.product.all_product', compact('allProducts'));
        }

        else{
            return back()->with("message", "Products couldn't be found.Please try again later.");
        }

    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $pageTitle = 'Add New Product';
        $brands = Brand::latest()->get(['id','brand_name']);
        $categories = Category::latest()->get(['id','category_name']);
        $vendors = User::where('role', 'vendor')->where('status', 'active')->latest()->get(['id','name']);
    
        return view('backend.product.add_product', compact('pageTitle', 'brands','categories','vendors'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $data = $request;

        $product = $this->productService->storeProduct($data);
        
        if($product){
            return redirect()->route('product.all')->with("message", "Product has been created successfully");
        }

        else{
            return back()->with('message', "Product couldn't be created. Please try again later.");
        }
       
    }

    /**
     * Display the specified product.
     */
    public function show(string $id)
    {   
        $pageTitle = "Product Details";
        $product = Product::with('multi_imgs','colors','sizes')->findOrFail($id);
 
        return view('backend.product.product_details', compact('product', 'pageTitle'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(string $id)
    {
        $pageTitle = "Edit Product";
        $product = Product::with('multi_imgs','colors','sizes','tags')->findOrFail($id);
        
        return view('backend.product.edit_product', compact('product','pageTitle'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request;
        $multiImages = $request->multi_imgs;
        $product = Product::with(['multi_imgs','tags','colors','sizes'])->findOrFail($id);
         
        $updatedProduct = $this->productService->updateProduct($product,$data,$multiImages); 

        if($updatedProduct){
            return redirect()->route('product.show', $product->id)->with('message', 'Product updated successfully');
        }

        else{
            return back()->with('message', "Product couldn't be updated.Please try again later.");
        }
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy(string $id)
    {
        
        $product = Product::with(['multi_imgs','tags','colors','sizes'])->find($id);

        if(!$product){
            return redirect()->route('product.all')->with("message", "Product couldn't be found.Please try again later."); 
        }

        $deletedProduct = $this->deleteProduct($product);
        
        $deletedProduct ? $message = "product deleted successfully" : $message = "Product couldn't be deleted.Please try again later.";
        
        return redirect()->route('product.all')->with("message", $message);

    }

    // get the subcategory which are under the selected category
    public function getSubCategory(string $category_id){

        $subcategory = SubCategory::where('category_id', $category_id)->latest()->get(['id', 'subcategory_name']);

        return response()->json($subcategory); 

    }

    // handle product status
    public function productStatus(string $id,$status){

        Product::where('id',$id)->update([
            "status" => $status == 1 ? "0" : "1"
        ]);

        $message = Product::findOrFail($id)->status == 1 ? "Product activated successfully" : "Product deactivated successfully";
            
        return back()->with('message', $message);
    }

    // filter the product by price
    public function productFilter(Request $request, $min = null, $max = null){

        if($request->search){
            $query = Product::where('product_name', 'like', '%' . $request->search . '%')->get();
        }

        ($min != null && $max == "null") ? 
        $allProducts = Product::where('discount_price', '>=', $min)->oldest('discount_price')->get() 
        : 
        $allProducts = Product::whereBetween('discount_price', [$min, $max])->oldest('discount_price')->get();
   
        return view('backend.product.all_product', compact('allProducts'));
    }

}
