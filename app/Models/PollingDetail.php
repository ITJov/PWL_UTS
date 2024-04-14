<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollingDetail extends Model
{
    use HasFactory;

    protected $table ='polling_date';

    protected $fillable =[
        'id',
        'polling_id',
        'user_id',
        'mata_kuliah_id',
    ];

    protected $primaryKey = 'id';

    public $incrementing =false;
    protected $keyType='string';

    public function namaPole(){
        return $this->belongsTo(Poling::class,'polling_id');
    }
    public function namaUser(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function namaMatKul(){
        return $this->belongsTo(MataKuliah::class,'mata_kuliah_id');
    }

}
