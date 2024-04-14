<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kurikulum extends Model
{
    use HasFactory;

    protected $table ='kurikulum';

    protected $fillable =[
        'id',
        'periode',
    ];
    protected $primaryKey = 'id';
    public $incrementing =false;
    protected $keyType='string';

}
