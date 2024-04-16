<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poling extends Model
{
    use HasFactory;

    protected $table ='polling';

    protected $fillable =[
        'id',
        'periode',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    public $incrementing =false;
    protected $keyType='string';

    public function namaKurikulum(){
        return $this->belongsTo(kurikulum::class,'kurikulum');
    }
}
