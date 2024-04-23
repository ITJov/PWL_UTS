<?php

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('role', function (Blueprint $table) {
            $table->string('id',10)->primary();
            $table->string('nama_role',45)->unique();
            $table->timestamp('updated_at')->useCurrent();
            $table->timestamp('created_at')->useCurrent();
        });

        $data = ['Admin'];

        for ($i = 0; $i < count($data); $i++) {
            DB::table('role')->insert([
                'id' => IdGenerator::generate(['table' => 'role', 'length' => 10, 'prefix' => 'RL-']),
                'nama_role' => $data[$i]
            ]);
        }



    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
