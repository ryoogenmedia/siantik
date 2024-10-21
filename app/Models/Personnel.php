<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personnel extends Model
{
    use HasFactory;

    protected $table = 'personnels';

    protected $fillable = [
        'user_id',
        'name',
        'position',
        'number_identity',
        'sex',
    ];

    public function attendances(){
        return $this->hasMany(Attendance::class,'personnel_id','id');
    }

    public function akun(){
        return $this->belongsTo(User::class,'user_id','id')->withDefault();
    }
}
