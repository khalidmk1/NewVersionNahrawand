<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable , HasRoles , SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'avatar',
        'cover',
        'firstName',
        'lastName',
        'isLogin',
        'isPopular',
        'password_change',
        'isUpdated',
        'isDelete',
        'biographie',
        'faceboock',
        'linkdin',
        'instagram',
        'datebirt',
        'status_matrimonial',
        'numChild',
        'profission',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Get all of the content for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function content(): HasMany
    {
        return $this->hasMany(Content::class, 'hostId');
    }

    /**
     * Get all of the vidoeguest for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function vidoeguest(): HasMany
    {
        return $this->hasMany(VideoGuest::class, 'userId');
    }

    /**
     * Get all of the eventUser for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eventUser(): HasMany
    {
        return $this->hasMany(EventUser::class, 'userId');
    }
}
