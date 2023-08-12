<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'profile_picture'
    ];

    public function pets()
    {
        return $this->belongsToMany(Pet::class)
            ->withPivot('finished');
    }
}
