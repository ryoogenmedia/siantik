<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    protected $fillable = [
        'personnel_id',
        'name',
        'check_in',
        'check_out',
        'status_attendance',
    ];

    public function personnel(){
        return $this->belongsTo(Personnel::class,'personnel_id','id')->withDefault();
    }
}
