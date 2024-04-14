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
        Schema::create('users', function (Blueprint $table) {
            $table->string('id',10)->primary();
            $table->string('name')->unique();
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role');
            $table->foreign('role')->references('id')->on('role');
            $table->string('kurikulum')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        $id = IdGenerator::generate(['table' => 'users', 'length' => 10, 'prefix' =>'PGN-']);
        DB::table('users')->insert([
            ['id' => $id,
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'password'=>'admin',
            'role'=>DB::table('role')->where('nama_role', 'Admin')->value('id')],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
