<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
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
    ];

    
    public function store($data)
    {
        $this->create($data);
    }

    public function rooms()
    {
        return $this->hasMany(Room::class, 'block_code', 'code'); 
        #One to many, one block, but a lot of rooms
    }
}
