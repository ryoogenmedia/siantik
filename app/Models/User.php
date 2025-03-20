<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'name',
        'phone_number',
        'avatar',
        'roles',
        'email',
        'email_verified_at',
        'password',
    ];

    public function personnel()
    {
        return $this->hasOne(Personnel::class, 'user_id', 'id')->withDefault();
    }

    // GET AVATAR URL
    public function avatarUrl()
    {
        $url = "";
        if (auth()->user()->email == 'muhbintang650@gmail.com' || auth()->user()->email == 'feryfadulrahman@gmail.com') {
            $url = $this->avatar
                ? url('storage/' . $this->avatar)
                : 'https://gravatar.com/avatar/' . md5(strtolower(trim($this->email))) . '?s=1024';
        } else {
            $url = $this->avatar
                ? url('storage/' . $this->avatar)
                : asset('ryoogen/no-img.png');
        }

        return $url;
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'user_id', 'id');
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'user_id', 'id');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
