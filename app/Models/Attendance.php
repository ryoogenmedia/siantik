<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    protected $fillable = [
        'user_id',
        'name',
        'check_in',
        'check_out',
        'status_attendance',
        'status_check_in',
        'status_check_out',
        'longitude',
        'latitude',
        'image',
    ];

    public function akun()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }
}
