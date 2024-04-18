<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Product;

class SubCategory extends Model
{
    use HasFactory;
    
    protected $table = "sub_categories";
    protected $fillable = [
        'category_id',
        'subcategory_name',
        'subcategory_slug'
    ];
    
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
}
