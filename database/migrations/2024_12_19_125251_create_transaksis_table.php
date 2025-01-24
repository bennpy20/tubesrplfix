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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id()->primary();
            $table->string('label', 50);
            $table->integer('amount');
            $table->string('jenis', 15);
            $table->string('note', 255)->nullable();
            $table->date('date');
            $table->unsignedBigInteger('id_dompet');
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_dompet')->references('id')->on('dompets')->onDelete('cascade');
            $table->foreign('id_user')->references('id')->on('penggunas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
