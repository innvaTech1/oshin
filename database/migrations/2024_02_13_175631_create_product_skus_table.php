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
        Schema::create('product_skus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("product_id")->nullable();
            $table->string("sku", 250)->nullable();
            $table->double("purchase_price", 16, 2)->default(0)->nullable();
            $table->double("selling_price", 16, 2)->default(0);
            $table->double('additional_shipping')->default(0)->nullable();
            $table->string('variant_image')->nullable();
            $table->boolean("status")->default(1);
            $table->unsignedInteger('product_stock')->default(0);
            $table->string('track_sku', 250)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_skus');
    }
};
