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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salon_id')->constrained('salons')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->boolean('is_cut')->default(false);
            $table->boolean('is_color')->default(false);
            $table->text('color_note', 200)->nullable();
            $table->boolean('is_perm')->default(false);
            $table->text('perm_note', 200)->nullable();
            $table->string('practitioner')->nullable();
            $table->text('memo', 1000)->nullable();
            $table->integer('point')->default(0);
            $table->dateTime('visit_date')->nullable();

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
        Schema::dropIfExists('cards');
    }
};
