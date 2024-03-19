<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;
    protected $table = 'mata_kuliah';

    protected $fillable = [
        'kode_mata_kuliah',
        'nama_mata_kuliah',
        'sks',
        'kurikulum_id',
    ];
    protected $primaryKey = 'kode_mata_kuliah';

}
