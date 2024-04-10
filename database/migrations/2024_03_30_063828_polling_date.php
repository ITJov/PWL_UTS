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
        Schema::create('polling_date',function(Blueprint $table){
            $table->string('id',10)->unique()->primary();
            $table->string('polling_id');
            $table->foreign('polling_id')->references('id')->on('polling');
            $table->string('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('mata_kuliah_id');
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
