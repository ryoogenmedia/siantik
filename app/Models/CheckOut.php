<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckOut extends Model
{
    use HasFactory;

    protected $table = 'check_outs';

    protected $fillable = [
        'user_id',
        'status',
        'image',
        'longitude',
        'latitude',
    ];

    public function akun()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withDefault();
    }

    public function imageUrl()
    {
        return $this->image ?
            asset('storage/' . $this->image) :
            asset('ryoogen/no-img.png');
    }
}
