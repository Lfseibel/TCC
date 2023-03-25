<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationDate extends Model
{
    use HasFactory;

    protected $primaryKey = ['date', 'reservation_code'];
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date',
        'reservation_code'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_code', 'code'); 
        #Many to one, one reservation but a lot of dates
    }
}
