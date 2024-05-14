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
        Schema::create('cupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->decimal('amount', 8, 2);
            $table->enum('type', ['fixed','percent']);
            $table->decimal('minimum_amount', 8, 2)->nullable();
            $table->integer('usage_limit')->nullable();
            $table->integer('used')->default(0);
            $table->dateTime('valid_from')->nullable();
            $table->dateTime('expires_at')->nullable();
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cupons');
    }
};
