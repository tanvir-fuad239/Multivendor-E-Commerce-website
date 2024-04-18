<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class multi_imgs extends Model
{
    use HasFactory;

    protected $table = 'multi_imgs';

    protected $fillable = [
        'product_id',
        'multi_image'
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
