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
            $table->string('product_name');
            $table->string('slug');
            $table->unsignedBigInteger('thumbnail_image_source');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('brand_id');
            $table->integer('unit_id')->nullable();
            $table->integer('qty')->default(0);
            $table->text('short_description');
            $table->longText('description');
            $table->longText('additional_information')->nullable();
            $table->string('video_link')->nullable();
            $table->string('sku');
            $table->string('batch', 50)->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->double('price');
            $table->double('discount')->nullable();
            $table->enum('discount_type', ['percent', 'flat'])->nullable();
            $table->date('offer_start_date')->nullable();
            $table->date('offer_end_date')->nullable();
            $table->boolean('is_cod')->nullable();
            $table->boolean('is_verified')->nullable();
            $table->boolean('is_wholesale')->default(0);
            $table->boolean('is_pre_order')->default(0);
            $table->date('release_date')->nullable();
            $table->tinyInteger('max_product')->default(1);
            $table->boolean('is_partial')->nullable()->default(false);
            $table->integer('partial_amount')->default(0);
            $table->string('delivery_location')->nullable();
            $table->string('badge')->nullable();
            $table->json('tags')->nullable();
            $table->boolean('is_return')->default(0);
            $table->integer('return_policy_id')->nullable();
            $table->double('avg_rating', 8, 2)->default(0);
            $table->boolean('is_warranty')->default(0);
            $table->string('warranty_duration')->nullable();
            $table->boolean('show_homepage')->default(0);
            $table->boolean('is_undefine')->default(0);
            $table->boolean('is_featured')->default(0);
            $table->boolean('is_approved')->default(0);
            $table->boolean('is_new')->default(0);
            $table->boolean('is_top')->default(0);
            $table->boolean('is_bestseller')->default(0);
            $table->boolean('is_flash_deal')->default(0);
            $table->boolean('buyone_getone')->default(0);
            $table->boolean('status')->default(0);
            $table->unsignedBigInteger('viewed')->default(0);


            $table->tinyInteger("product_type")->nullable()->comment('1 => single_product, 2 => variant_product');
            $table->unsignedBigInteger("unit_type_id")->nullable();

            $table->string("barcode_type", 255)->nullable();
            $table->string("model_number", 255)->nullable();
            $table->Integer("shipping_type")->default(0)->comment('1 => free_shipping, 2 => flat_rate');
            $table->double("shipping_cost", 16, 2)->default(0);

            $table->string("tax_type", 50)->nullable();
            $table->double("tax", 16, 2)->default(0);
            $table->string("pdf", 255)->nullable();
            $table->string("video_provider", 255)->nullable();


            $table->longText('specification')->nullable();
            $table->Integer("minimum_order_qty")->nullable();
            $table->double('min_sell_price', 28, 2)->default(0);
            $table->double('max_sell_price', 28, 2)->default(0);
            $table->unsignedBigInteger('total_sale')->default(0);
            $table->Integer("min_order_qty")->nullable();
            $table->Integer("max_order_qty")->nullable();
            $table->boolean('is_physical')->default(0);
            $table->tinyInteger('display_in_details')->default(0);
            $table->unsignedInteger('requested_by')->nullable();
            $table->string('stock_manage')->default(0);
            $table->timestamp('recent_view')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();

            $table->softDeletes();
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
