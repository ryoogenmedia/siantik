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
        'time_check_in_start',
        'time_check_in_end',
        'time_check_out_start',
        'time_check_out_end',
        'logo',
        'radius',
    ];
}
