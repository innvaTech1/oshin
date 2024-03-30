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
            $table->string('name');
            $table->string('slug');
            $table->string('thumb_image');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('brand_id');
            $table->integer('qty')->default(0);
            $table->text('short_description');
            $table->longText('long_description');
            $table->string('video_link')->nullable();
            $table->string('sku');
            $table->text('seo_title');
            $table->text('seo_description');
            $table->double('price');
            $table->double('discount')->nullable();
            $table->enum('discount_type',['discount','flat'])->nullable();
            $table->date('offer_start_date')->nullable();
            $table->date('offer_end_date')->nullable();
            $table->boolean('is_cash_delivery')->default(0);
            $table->boolean('is_wholesale')->default(0);
            $table->boolean('is_pre_order')->default(0);
            $table->date('pre_order_date')->nullable();
            $table->boolean('partial_payment')->default(0);
            $table->string('partial_payment_amount')->nullable();
            $table->string('delivery_location')->nullable();
            $table->boolean('is_return')->default(0);
            $table->integer('return_policy_id')->nullable();
            $table->boolean('is_warranty')->default(0);
            $table->boolean('show_homepage')->default(0);
            $table->boolean('is_undefine')->default(0);
            $table->boolean('is_featured')->default(0);
            $table->boolean('new_product')->default(0);
            $table->boolean('is_top')->default(0);
            $table->boolean('is_best')->default(0);
            $table->boolean('is_flash_deal')->default(0);
            $table->boolean('buyone_getone')->default(0);
            $table->boolean('status')->default(0);
            $table->integer('viewed')->default(0);
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
