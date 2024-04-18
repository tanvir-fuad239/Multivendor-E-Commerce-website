<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;


class ProductTag extends Model
{
    use HasFactory;

    protected $table = 'product_tags';
    protected $fillable = [
        'product_id',
        'product_tag'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
