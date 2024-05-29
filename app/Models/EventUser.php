<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'eventId',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'userId' => 'array',
    ];

    /**
     * Get the user that owns the EventUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }

    /**
     * Get the event that owns the EventUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class, 'eventId');
    }
}
