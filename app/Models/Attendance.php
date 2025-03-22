<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PDO;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    protected $fillable = [
        'user_id',
        'check_in_id',
        'check_out_id',
        'permission_id',
        'status_attendance',
        'is_permission',
    ];

    public function check_in()
    {
        return $this->belongsTo(CheckIn::class, 'check_in_id', 'id')->withDefault();
    }

    public function check_out()
    {
        return $this->belongsTo(CheckOut::class, 'check_out_id', 'id')->withDefault();
    }

    public function akun()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id', 'id')->withDefault();
    }
}
