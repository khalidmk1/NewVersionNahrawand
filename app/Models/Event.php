<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'image',
        'url',
        'title',
        'description',
        'dateStart',
        'dateEnd',
        'isUpdated',
        'isDelete'
    ];

    /**
     * Get all of the eventUser for the Event
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function eventUser(): HasMany
    {
        return $this->hasMany(EventUser::class, 'eventId');
    }
    
}
