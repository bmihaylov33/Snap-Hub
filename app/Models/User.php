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
        'email',
        'password',
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

    /**
    * Add the role relationship to the user.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    /**
    * Add the permission relationship to the user.
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }
}
