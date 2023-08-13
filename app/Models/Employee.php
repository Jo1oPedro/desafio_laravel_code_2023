<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    const WORK_TIMES = ['morning', 'afternoon', 'night'];

    protected $fillable = [
        'user_id',
        'work_time'
    ];

    public function pets()
    {
        return $this->belongsToMany(Pet::class, 'pet_user')
            ->withPivot(['value', 'work_done', 'finished_at']);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
