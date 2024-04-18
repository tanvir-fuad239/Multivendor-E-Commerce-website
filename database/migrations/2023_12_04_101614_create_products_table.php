<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('brand_id');
            $table->integer('category_id');
            $table->integer('sub_category_id');
            $table->string('product_name');
            $table->string('product_slug');
            $table->string('product_code');
            $table->integer('product_quantity');
            $table->float('product_price');
            $table->float('discount_price')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('long_description')->nullable();
            $table->string('product_image');
            $table->integer('vendor_id');
            $table->string('hot_deals')->nullable();
            $table->string('featured')->nullable();
            $table->string('special_offer')->nullable();
            $table->string('special_deals')->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
