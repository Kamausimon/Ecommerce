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
        Schema::create('product', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('image_path')->nullable();
            $table->string('name');
            $table->mediumText('description', 1000);
            $table->string('SKU');
            $table->decimal('price');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('inventory_id');
            $table->unsignedBigInteger('discount_id')->nullable();

            //foreign keys
            $table->foreign('category_id')->references('id')->on('product_category')->onDelete('cascade');
            $table->foreign('inventory_id')->references('id')->on('product_inventory')->onDelete('cascade');
            $table->foreign('discount_id')->references('id')->on('discount')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
