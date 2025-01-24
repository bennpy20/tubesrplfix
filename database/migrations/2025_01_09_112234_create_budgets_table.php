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
        Schema::create('budgets', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('label', 30);
            $table->integer('income');
            $table->integer('expense');
            $table->string('periode', 15);
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id')->on('penggunas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('budgets');
    }
};