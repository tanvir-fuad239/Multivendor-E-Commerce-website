<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;


class ProductColor extends Model
{
    use HasFactory;

    protected $table = 'product_colors';
    protected $fillable = [
        'product_id',
        'product_color'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

}
