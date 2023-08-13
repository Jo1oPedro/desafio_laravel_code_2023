<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\traits\SpecializedPersonTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        SpecializedPersonTrait;

    /**
     * @var array<string, string>
     */
    const USER_SPECIALIZATION = ['employees', 'admins'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_specialization',
        'person_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
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

    public function people()
    {
        return $this->belongsTo(Person::class);
    }

    public function admins()
    {
        return $this->hasMany(Admin::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function scopeWhereEmail($query, $email)
    {
        return $query->where(
            'id',
            Person::where('email', $email)
                ->first()
                ?->id
        );
    }

    public function scopeWherePersonIsUser($query)
    {
        return $query->where(
            'id',
            Person::where('person_specialization', 'users')
                ->first()
                ?->id
        );
    }
}
