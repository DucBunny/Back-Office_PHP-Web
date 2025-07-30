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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer('gender')->notNullable()->comment('1: male / 2: female / 3: other');
            $table->integer('age')->nullable();
            $table->integer('point')->default(0);
            $table->text('notes', 1000)->nullable();

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
        Schema::dropIfExists('customers');
    }
};
