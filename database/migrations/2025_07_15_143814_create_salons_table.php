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
            $table->string('salon_code', 20)->nullable();
            $table->integer('type')->comment('1: Cắt tóc / 2: Tạo kiểu');
            $table->string('name')->nullable();
            $table->string('furigana')->nullable();
            $table->string('address')->nullable();
            $table->integer('color_plus_point')->default(0);
            $table->integer('perm_plus_point')->default(0);
            $table->boolean('status')->default(true)->comment('true: Công khai');

            $table->timestamps();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->softDeletes();

            $table->foreign('updated_by')->references('id')->on('users');
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
