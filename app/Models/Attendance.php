<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    protected $fillable = [
        'check_in_id',
        'check_out_id',
        'permission_id',
        'status_attendance',
        'is_permission',
    ];

    public function akun()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }
}
