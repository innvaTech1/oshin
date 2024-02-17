<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seller_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_id');
            $table->double('tax')->default(0);
            $table->string('tax_type')->nullable();
            $table->double('discount')->default(0);
            $table->string('discount_type')->nullable();
            $table->date('discount_start_date')->nullable();
            $table->date('discount_end_date')->nullable();
            $table->string('product_name', 255)->nullable();
            $table->string("slug", 255)->nullable();
            $table->string('thum_img', 255)->nullable();
            $table->boolean('status')->default(1);
            $table->tinyInteger('stock_manage')->default(0);
            $table->boolean('is_approved')->default(0);
            $table->double('min_sell_price', 28, 2)->default(0);
            $table->double('max_sell_price', 28, 2)->default(0);
            $table->unsignedBigInteger('total_sale')->default(0);
            $table->double('avg_rating', 8, 2)->default(0);
            $table->timestamp('recent_view')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seller_products');
    }
};
