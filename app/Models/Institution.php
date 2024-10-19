<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;

    protected $table = 'institutions';

    protected $fillable  = [
        'name',
        'longitude',
        'latitude',
        'address',
        'time_check_in',
        'time_check_out',
        'logo',
        'radius',
    ];
}
