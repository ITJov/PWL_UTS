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
        'semester',
        'tanggal_mulai',
        'tanggal_selesai',
    ];

    protected $primaryKey = 'id';

    public $incrementing =false;
    protected $keyType='string';
}
