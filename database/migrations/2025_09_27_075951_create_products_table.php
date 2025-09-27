<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // database/migrations/xxxx_xx_xx_create_products_table.php
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->constrained('vendors')->onDelete('cascade');
            $table->foreignId('godown_id')->constrained('godowns')->onDelete('cascade');
            $table->string('category')->nullable();
            $table->string('sub_category')->nullable();
            $table->string('material')->nullable();
            $table->string('product_image')->nullable();
            $table->string('color')->nullable();
            $table->tinyInteger('quality_rating')->default(1);
            $table->decimal('rent_per_day', 8, 2);
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
