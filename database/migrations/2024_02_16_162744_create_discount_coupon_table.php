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
        Schema::create('discount_coupon', function (Blueprint $table) {

            $table->id();
            $table->string('discount_code');
            $table->string('discount_rate');
            $table->string('discount_active_time');
            $table->string('discount_code_type');
            $table->string('discount_on_category');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_coupon');
    }
};
