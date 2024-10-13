<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leader extends Model
{
    use HasFactory;

    protected $table = 'leaders';

    protected $fillable = [
        'user_id',
        'name',
        'address',
        'sex',
    ];

    public function akun(){
        return $this->belongsTo(User::class,'user_id','id')->withDefault();
    }
}
