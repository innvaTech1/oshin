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
        Schema::create('wholesale_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sku_id');
            $table->double('min_qty', 28, 2)->default(0);
            $table->double('max_qty', 28, 2)->default(0);
            $table->double('price', 28, 2)->default(0);
            $table->boolean('status')->default(1);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wholesale_prices');
    }
};
