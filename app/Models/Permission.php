<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $table = 'permissions';

    protected $fillable = [
        'user_id',
        'file',
        'status_permission',
        'information',
        'date_start',
        'date_end',
    ];

    public function akun(){
        return $this->belongsTo(User::class,'user_id','id')->withDefault();
    }
}
