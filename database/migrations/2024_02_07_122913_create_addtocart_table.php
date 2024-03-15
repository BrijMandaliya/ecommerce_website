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
        Schema::create('addtocart', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->foreignId('product_id')->constrained();
            $table->string('product_size')->nullable();
            $table->string('product_color')->nullable();
            $table->string('product_quantity');
            $table->string('product_image');
            $table->bigInteger('product_price');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->bigInteger('product_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {
        Schema::dropIfExists('addtocart');
    }
};
