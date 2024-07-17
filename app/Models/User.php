<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
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

    /**
     * Get all of the contentFavoris for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contentFavoris(): HasMany
    {
        return $this->hasMany(ContentFavoris::class, 'userId');
    }

    /**
     * Get all of the contentViews for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contentViews(): HasMany
    {
        return $this->hasMany(ContentView::class, 'userId')->whereNull('deleted_at');;
    }

    /**
     * Get all of the videoViews for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videoViews(): HasMany
    {
        return $this->hasMany(Comment::class, 'userId');
    }

    /**
     * Get all of the contentFinished for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contentFinished(): HasMany
    {
        return $this->hasMany(ContentFinished::class, 'userId');
    }

    /**
     * Get all of the contentComments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contentComments(): HasMany
    {
        return $this->hasMany(ContentComment::class, 'userId');
    }

    /**
     * Get all of the managedTickets for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function managedTickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'managerId');
    }

    /**
     * Get all of the clientTickets for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function clientTickets(): HasMany
    {
        return $this->hasMany(Ticket::class, 'clientId');
    }

    /**
     * Get all of the subCategory for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subCategory(): HasMany
    {
        return $this->hasMany(UserSubcategory::class, 'userId');
    }
    /**
     * Get all of the ticketComments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ticketComments(): HasMany
    {
        return $this->hasMany(TicketComment::class, 'userId');
    }

    /**
     * Get all of the objectives for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function objectives(): HasMany
    {
        return $this->hasMany(UserObjective::class, 'userId');
    }

    /**
     * Get all of the quizAnswer for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quizAnswer(): HasMany
    {
        return $this->hasMany(QuizAnswerQuestion::class, 'userId');
    }
}
