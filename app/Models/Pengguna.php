<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengguna extends Model
{
    use HasFactory;
    protected $table ='user';

    protected $fillable =[
        'id',
        'namaUser',
        'email',
        'password',
        'role'
    ];

    public $incrementing =false;
    protected $keyType='string';
}
