<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;
    protected $table = 'mata_kuliah';

    protected $fillable = [
        'id',
        'nama_mata_kuliah',
        'sks',
        'kurikulum_id',
    ];
    protected $primaryKey = 'id';

    public $incrementing =false;
    protected $keyType='string';

    public function namaKurikulum(){
        return $this->belongsTo(kurikulum::class,'kurikulum_id');
    }

}
