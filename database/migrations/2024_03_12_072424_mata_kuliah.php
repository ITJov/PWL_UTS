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
        schema::create('mata_kuliah', function (Blueprint $table)
        {
            $table->string('kode_mata_kuliah',5);
            $table->string('nama_mata_kuliah',45);
            $table->string('sks',2);
            $table->string('kurikulum_id',2);
            $table->foreign('kurikulum_id')->references('kurikulum_id')->on('kurikulum');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
