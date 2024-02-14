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
        Schema::create('log_activities', function (Blueprint $table) {
            $table->id();
            $table->longText('subject');
            $table->tinyInteger('type')->default(1);
            $table->longText('url')->nullable();
            $table->string('method')->nullable();
            $table->string('ip')->nullable();
            $table->boolean('login')->default(false);
            $table->dateTime('login_time')->nullable();
            $table->dateTime('logout_time')->nullable();
            $table->string('agent')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('user_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_activities');
    }
};
