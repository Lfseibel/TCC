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

    protected $primaryKey = 'email';
    public $incrementing = false;
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'password',
        'type',
        'unity_code'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function unity()
    {
        return $this->belongsTo(Unity::class, 'unity_code', 'code'); 
        #Many to one, a lot of users, but one unity
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'user_email', 'email'); 
        #One to many, one user, but a lot of reservations
    }

    public function store($data)
    {
        $password = $data['password'];
        $data['password'] = bcrypt($password);
        $this->create($data);
    }

    
}
