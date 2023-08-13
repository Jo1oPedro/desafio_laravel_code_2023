<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    const PERSON_SPECIALIZATIONS = ['users', 'owners'];

    //protected $table = 'persons';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'birthdate',
        'address_id',
        'phone_number_id',
        'person_specialization'
    ];

    protected $hidden = [
        'password',
    ];

    public function users()
    {
        return $this->hasMany(
            User::class,
            'people_id'
        );
    }

    public function owners()
    {
        return $this->hasMany(
            Owner::class,
            'people_id'
        );
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function phone_number()
    {
        return $this->belongsTo(PhoneNumber::class);
    }
}
