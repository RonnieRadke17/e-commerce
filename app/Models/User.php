<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'paternal',
        'maternal',
        'birthdate',
        'gender',
        'email',
        'password',
        'is_suspended',
        'role_id',
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

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    //relations with events ALEXIS metodo
    
    /* public function events()
    {
        return $this->belongsToMany(Event::class)->withTimestamps();
    } */

    //relations with payments
    public function payments()
    {
        return $this->belongsToMany(Event::class, 'payments')->withTimestamps();
    }

    /* //relations with roles
    public function roles()
    {
        return $this->belongsTo(Role::class)->withTimestamps();
    } */
    // Relación con el modelo Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    public function events()
    {
        return $this->belongsToMany(Event::class, 'event_user', 'user_id', 'event_id');
    }
    

}