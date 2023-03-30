<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $primaryKey = 'code';
    public $incrementing = false;
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'capacity',
        'reduced_capacity',
        'block_code'
    ];

    public function block()
    {
        return $this->belongsTo(Block::class, 'block_code', 'code'); 
        #Many to one, a lot of rooms, but one block
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'room_code', 'code'); 
        #One to many, one room, but a lot of reservations
    }

    public function unities()
    {
        return $this->belongsToMany(Unity::class);
        #Many to many, many rooms and many unities
    }

    public function store($data)
    {
        return $this->create($data);
    }
}
