<?php

namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductService extends Controller{

    public function indexProduct($products, $key){
        
        if($key != null){
            $sorted_element = ($key == "name") ? 'product_name' : 'discount_price';

            $allProducts = Product::orderBy($sorted_element, 'asc')->get(['id','product_name','product_price','discount_price','product_image']);

            return $allProducts;
        }

        return $products;

    }

    public function storeProduct($data){
        
        // product thumbnail setup
        $productImage = $data->file('product_image');
        
        if($productImage){
            $productImageName = uniqid() . '.' . $productImage->getClientOriginalExtension();
            $productImage->move($this->getImagePath("product"),$productImageName);
        }

        // product setup 
        $product = new Product();

        $product->product_name = $data->product_name;
        $product->product_slug = Str::slug($data->product_name, '-');
        $product->product_code = $data->product_code;
        $product->product_quantity = $data->product_quantity;
        $product->short_description = @$data->short_descp ?? null;
        $product->long_description = $data->long_descp ? strip_tags($data->long_descp) : null;
        $product->product_image = @$productImageName ?? 'not found';
        $product->product_price = $data->product_price;
        $product->discount_price = @$data->discount_price ?? 0;
        $product->brand_id = $data->product_brand;
        $product->category_id = $data->product_category;
        $product->sub_category_id = $data->product_subcategory == "Not Found" ? 0 : $data->product_subcategory;
        $product->vendor_id = $data->vendor_id;
        $product->hot_deals = $data->has('hot_deals') ? 1 : 0;
        $product->featured = $data->has('featured') ?  1 : 0;
        $product->special_offer = $data->has('special_offers') ?  1 : 0;
        $product->special_deals = $data->has('special_deals') ?  1 : 0;
        $product->status = 1;

        if($product->save()){
        
            $productId = $product->id;

            $productMultiImages = $data->file('multi_imgs');          
            $productTags = explode(',',$data->product_tag);
            $productColors = explode(',', $data->product_color);
            $productSizes = explode(',', $data->product_size);

            $this->SaveMultiImage($productId, $productMultiImages);
            $this->SaveProductTag($productId, $productTags);
            $this->SaveProductColor($productId, $productColors);
            $this->SaveProductSize($productId, $productSizes);

            return $product;
        }

        else{
            return null;
        }

    }

    public function updateProduct($product,$data,$multiImages){

        // dd($productTags = explode(',',$data->product_tag));

        $oldImage = $product->product_image;
        $newImage = $data->file('product_image');

        if($newImage){
            $customImageName = uniqid() . '.' . $newImage->getClientOriginalExtension();
        }

        else{
            $customImageName = $oldImage;
        }

        $product->product_name = $data->product_name;
        $product->product_slug = Str::slug($data->product_name, '-');
        $product->product_code = $data->product_code;
        $product->product_quantity = $data->product_quantity;
        $product->short_description = $data->short_descp;
        $product->long_description = strip_tags($data->long_descp);
        $product->product_image = $customImageName;
        $product->product_price = $data->product_price;
        $product->discount_price = $data->discount_price;

        if($product->update()){

            $productId = $product->id;
            $productTags = explode(',',$data->product_tag);
            $productColors = explode(',', $data->product_color);
            $productSizes = explode(',', $data->product_size);
            
            if(!$newImage == null){
                $this->newImageMove($oldImage,$newImage,$customImageName);
            }
            
            if(!$multiImages == null){
                $this->deleteMultiImage($product);
                $this->SaveMultiImage($productId,$multiImages);
            }
            
            // for product tags
            $this->deleteProductTag($product);
            $this->SaveProductTag($productId,$productTags);

            // for product color 
            $this->deleteProductColor($product);
            $this->SaveProductColor($productId,$productColors);

            // for product size
            $this->deleteProductSize($product);
            $this->SaveProductSize($productId,$productSizes);

            return $product;

        }

        else{
            return null;
        }

    }
    
    public function newImageMove($oldImage,$newImage,$customImageName){

        $oldImagePath = $this->getImagePath("product") . $oldImage;

        if(File::exists($oldImagePath)){
            File::delete($oldImagePath);
        }
        
        $newImage->move($this->getImagePath("product"), $customImageName);

    }

}