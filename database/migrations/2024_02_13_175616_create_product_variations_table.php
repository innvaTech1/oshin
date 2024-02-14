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
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("product_id");
            $table->unsignedBigInteger("product_sku_id")->nullable();
            $table->unsignedBigInteger("attribute_id")->nullable();
            $table->unsignedBigInteger("attribute_value_id")->nullable();
            $table->unsignedBigInteger("created_by")->nullable();
            $table->unsignedBigInteger("updated_by")->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variations');
    }
};
