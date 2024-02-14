<?php

use App\Models\Color;
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
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("attribute_value_id")->nullable();
            $table->string("name", 50);
            $table->timestamps();
        });

        Color::create([
            'attribute_value_id' => 1,
            'name' => 'Black',
        ]);
        Color::create([
            'attribute_value_id' => 2,
            'name' => 'Red',
        ]);
        Color::create([
            'attribute_value_id' => 3,
            'name' => 'White',
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colors');
    }
};
