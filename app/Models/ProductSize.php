<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;


class ProductSize extends Model
{
    use HasFactory;

    protected $table = 'product_sizes';
    protected $fillable = [
        'product_id',
        'product_size'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
