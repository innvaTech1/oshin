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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("product_name")->nullable();
            $table->string("slug", 255)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger("product_type")->nullable()->comment('1 => single_product, 2 => variant_product');
            $table->unsignedBigInteger("unit_type_id")->nullable();
            $table->unsignedBigInteger("brand_id")->nullable();
            $table->string("thumbnail_image_source", 255)->nullable();
            $table->string("barcode_type", 255)->nullable();
            $table->string("model_number", 255)->nullable();
            $table->Integer("shipping_type")->default(0)->comment('1 => free_shipping, 2 => flat_rate');
            $table->double("shipping_cost", 16, 2)->default(0);
            $table->string("discount_type", 50)->nullable();
            $table->double("discount", 16, 2)->default(0);
            $table->string("tax_type", 50)->nullable();
            $table->double("tax", 16, 2)->default(0);
            $table->string("pdf", 255)->nullable();
            $table->string("video_provider", 255)->nullable();
            $table->string("video_link", 255)->nullable();
            $table->longText("description")->nullable();
            $table->longText('specification')->nullable();
            $table->Integer("minimum_order_qty")->nullable();
            $table->double('min_sell_price', 28, 2)->default(0);
            $table->double('max_sell_price', 28, 2)->default(0);
            $table->unsignedBigInteger('total_sale')->default(0);
            $table->Integer("max_order_qty")->nullable();
            $table->string("meta_title", 255)->nullable();
            $table->longText("meta_description")->nullable();
            $table->string("meta_image", 255)->nullable();
            $table->boolean('is_physical')->default(0);
            $table->boolean('is_approved')->default(0);
            $table->unsignedTinyInteger('status')->default(1);
            $table->tinyInteger('display_in_details')->default(0);
            $table->unsignedInteger('requested_by')->nullable();
            $table->unsignedBigInteger("created_by")->nullable();
            $table->unsignedBigInteger("updated_by")->nullable();
            $table->string('stock_manage')->default(0);
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
        Schema::dropIfExists('products');
    }
};
