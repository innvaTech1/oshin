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
        Schema::create('thanas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('district_id')->nullable();
            $table->string('name')->nullable();
            $table->string('bn_name')->nullable();
            $table->decimal('latitude', 18, 14)->nullable();
            $table->decimal('longitude', 18, 14)->nullable();
            $table->string('website')->nullable();
            $table->boolean('status')->nullable()->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thanas');
    }
};
