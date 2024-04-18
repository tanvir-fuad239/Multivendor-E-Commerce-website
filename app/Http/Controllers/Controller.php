<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\multi_imgs;
use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Models\ProductTag;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\File;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    // global methods for all controllers

    protected function deleteCategory($category){
        
        $categoryImage = $this->getImagePath("category") . $category->category_image;

        foreach($category->subcategories as $subcategory){
            $id = $subcategory->id;
            $eachSubCategory = SubCategory::with(['products'])->findOrFail($id);
            $this->deleteSubCategory($eachSubCategory);
        }

        if(File::exists($categoryImage)){
            File::delete($categoryImage);
        }

        return $category->delete();
        
    }

    protected function deleteSubCategory($subCategory){
       
        foreach($subCategory->products as $product){
            $id = $product->id;
            $eachProduct = Product::with(['multi_imgs','tags','colors','sizes'])->findOrFail($id);
            $this->deleteProduct($eachProduct);
        }

        return $subCategory->delete();

    }

    protected function deleteProduct($product){

        $productImage =  $this->getImagePath("product"). $product->product_image;

        $this->deleteMultiImage($product);
        $this->deleteProductTag($product);
        $this->deleteProductColor($product);
        $this->deleteProductSize($product);

        if(File::exists($productImage)){
            File::delete($productImage);
        }

        return $product->delete();
    }

    protected function SaveMultiImage($productId, $productMultiImages){

        if($productMultiImages){
            foreach($productMultiImages as $img){

                $multiImageName = uniqid() . '.' . $img->getClientOriginalExtension();
                $img->move($this->getMultiImagePath(), $multiImageName);

                $multiImags = new multi_imgs();
                $multiImags->product_id = $productId;
                $multiImags->multi_image = $multiImageName;

                $multiImags->save();

            }
        }

    }

    protected function deleteMultiImage($product){
        
        foreach($product->multi_imgs as $img){
            $multiImagePath = $this->getImagePath("multi_imgs") . $img->multi_image;

            if(File::exists($multiImagePath)){
                File::delete($multiImagePath);
            }
            
        }
        return $product->multi_imgs->each->delete();

    }

    protected function SaveProductTag($productId, $productTags){

        if($productTags && $productId){
            foreach($productTags as $tag){
                $productTag =  new ProductTag();
                $productTag->product_id = $productId;
                $productTag->product_tag = $tag;

                $productTag->save();
            }
        }

    }

    protected function deleteProductTag($product){
        return $product->tags->each->delete();
    }

    protected function SaveProductColor($productId, $productColors){

        if($productColors && $productId){
            foreach($productColors as $color){
                $productColor =  new ProductColor();
                $productColor->product_id = $productId;
                $productColor->product_color = $color;

                $productColor->save();
            }
        }

    }

    protected function deleteProductColor($product){
        return $product->colors->each->delete();
    }
    
    protected function SaveProductSize($productId, $productSizes){
        
        if($productSizes && $productId){
            foreach($productSizes as $size){
                $productSize =  new ProductSize();
                $productSize->product_id = $productId;
                $productSize->product_size = $size;

                $productSize->save();
            }
        }

    }

    protected function deleteProductSize($product){
        return $product->sizes->each->delete();
    }

    protected function getImagePath($folderName){
        return public_path("/uploads/" . $folderName . "/images/");
    }

    protected function getMultiImagePath(){
        return public_path("/uploads/multi_imgs/images/");
    }

    // product search 

    public function serachProduct($result){

        // category search
        $category = Category::with('products')->where('category_name', 'like', '%' . $result . '%')->first();

        // subcategory search
        $subCategory = SubCategory::with('products')->where('subcategory_name', 'like', '%' . $result . '%')->first();

        if(!$category == null){
            $allProducts = $category->products;
            return $allProducts;
        }
        
        elseif(!$subCategory == null){
            $allProducts = $subCategory->products;
            return $allProducts;
        }

        // product search
        $allProducts = Product::where('product_name', 'like', '%' . $result . '%')->get();
        return $allProducts;

    }
}
