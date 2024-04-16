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
            $table->string('id',10)->unique()->primary();
            $table->string('nama_mata_kuliah',45);
            $table->integer('sks');
            $table->string('kurikulum_id',10);
            $table->foreign('kurikulum_id')->references('id')->on('kurikulum')->onDelete('cascade');
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
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
