<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $primaryKey = 'code';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'acronym',
        'class',
        'description',
        'observation',
        'responsible',
        'startTime',
        'endTime',
        'room_code',
        'user_email'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_code', 'code'); 
        #Many to one, a lot of reservations but one room
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_email', 'email'); 
        #Many to one, a lot of reservations but one user
    }

    public function reservationDates()
    {
        return $this->hasMany(ReservationDate::class, 'reservation_code', 'code'); 
        #One to many, one reservation but a lot of dates
    }

    public function store($data)
    {
        return $this->create($data);
    }
}
