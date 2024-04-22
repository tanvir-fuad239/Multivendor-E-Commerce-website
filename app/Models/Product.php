<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\multi_imgs;
use App\Models\ProductTag;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\User;


class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable = [
        'brand_id',
        'category_id',
        'sub_category_id',
        'product_name',
        'product_slug',
        'product_code',
        'product_quantity',
        'product_price',
        'product_image',
        'vendor_id'
    ];

    public function multi_imgs(){
        return $this->hasMany(multi_imgs::class);
    }

    public function tags(){
        return $this->hasMany(ProductTag::class);
    }

    public function colors(){
        return $this->hasMany(ProductColor::class); 
    }
    
    public function sizes(){
        return $this->hasMany(ProductSize::class);
    }
    
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function subcategory(){
        return $this->belongsTo(SubCategory::class);
    }

    public function user(){
        return $this->hasOne(User::class, 'id', 'vendor_id');
    }
}
