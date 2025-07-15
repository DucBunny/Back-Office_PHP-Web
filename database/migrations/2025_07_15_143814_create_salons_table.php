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
        Schema::create('salons', function (Blueprint $table) {
            $table->id();
            $table->string('type')->comment('Cắt tóc / Chăm sóc sắc đẹp');
            $table->string('name')->nullable();
            $table->string('furigana')->nullable();
            $table->string('location')->nullable();
            $table->integer('color_plus_point')->default(0);
            $table->integer('perm_plus_point')->default(0);
            $table->boolean('status')->default(true)->comment('true: công khai');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salons');
    }
};
