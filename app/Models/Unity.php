<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unity extends Model
{
    use HasFactory;

    protected $primaryKey = 'code';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'code',
        'name',
    ];


    public function users()
    {
        return $this->hasMany(User::class, 'unity_code', 'code'); 
        #One to many, one unity, but a lot of users
    }

    public function rooms()
    {
        return $this->belongsToMany(Rooms::class);
    }

    public function store($data)
    {
        $this->create($data);
    }

   
}
