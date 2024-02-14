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
        Schema::create('attributes', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255);
            $table->string("display_type", 70)->nullable();
            $table->text("description")->nullable();
            $table->boolean("status")->default(0);
            $table->unsignedBigInteger("created_by")->nullable();
            $table->unsignedBigInteger("updated_by")->nullable();
            $table->timestamps();
        });
        DB::statement("INSERT INTO `attributes` (`id`, `name`, `display_type`, `description`, `status`, `created_at`, `updated_at`) VALUES
        (1, 'Color', 'radio_button', 'this is for color attribute.', 1, '2024-02-14 02:12:26', '2024-02-14 02:12:26')");

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attributes');
    }
};
