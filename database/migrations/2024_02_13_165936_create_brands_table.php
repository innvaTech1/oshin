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
        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255);
            $table->unsignedBigInteger("logo")->nullable();
            $table->text("description")->nullable();
            $table->string("link", 255)->nullable();
            $table->boolean("status")->default(1);
            $table->boolean("featured")->default(0);
            $table->text("meta_title")->nullable();
            $table->text("meta_description")->nullable();
            $table->unsignedBigInteger("sort_id")->nullable();
            $table->unsignedBigInteger('total_sale')->default(0);
            $table->double('avg_rating', 8, 2)->default(0);
            $table->string("slug", 255)->nullable();
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
        Schema::dropIfExists('brands');
    }
};
