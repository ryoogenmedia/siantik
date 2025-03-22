<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckIn extends Model
{
    use HasFactory;

    protected $table = "check_ins";

    protected $fillable = [
        'user_id',
        'status',
        'image',
        'longitude',
        'latitude',
    ];
}
