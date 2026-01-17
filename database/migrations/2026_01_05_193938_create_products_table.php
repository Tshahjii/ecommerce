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
            $table->string('product_title', 50)->nullable();
            $table->string('product_slug', 50)->nullable();
            $table->text('description')->nullable();
            $table->string('manufacturer_name', 50)->nullable();
            $table->string('manufacturer_brand', 50)->nullable();
            $table->integer('stocks')->nullable();
            $table->decimal('product_price', 10, 2)->nullable();
            $table->decimal('compare_price', 10, 2)->nullable();
            $table->decimal('product_discount', 10, 2)->nullable();
            $table->enum('is_featured', ['yes', 'no'])->default('yes');
            $table->enum('product_status', ['active', 'inactive', 'suspended'])->default('active');
            $table->string('meta_title', 100)->nullable();
            $table->string('meta_keywords', 100)->nullable();
            $table->text('meta_description')->nullable();
            $table->unsignedBigInteger('category')->nullable();
            $table->unsignedBigInteger('child_category')->nullable();
            $table->unsignedBigInteger('sub_category')->nullable();
            $table->string('related_product')->nullable();
            $table->unsignedBigInteger('brands')->nullable();
            $table->string('barcodes')->nullable();
            $table->dateTime('released_date')->nullable();
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
