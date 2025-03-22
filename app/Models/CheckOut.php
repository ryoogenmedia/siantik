<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckOut extends Model
{
    use HasFactory;

    protected $table = 'check_outs';

    protected $fillable = [
        'user_id',
        'status',
        'image',
        'longitude',
        'latitude',
    ];
}
