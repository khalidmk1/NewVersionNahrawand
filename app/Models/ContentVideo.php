<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContentVideo extends Model
{
    use HasFactory ,  HasTags , SoftDeletes;

    protected $fillable = [
        'contentId',
        'title',
        'description',
        'image',
        'video',
        'isComing',
        'isUpdated',
        'isDelete',
        'duration'
    ];


    /**
     * Get the content that owns the ContentVideo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'contentId');
    }

    /**
     * Get all of the videoguest for the ContentVideo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videoguest(): HasMany
    {
        return $this->hasMany(VideoGuest::class, 'VideoId');
    }

    /**
     * Get all of the views for the ContentVideo
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function views(): HasMany
    {
        return $this->hasMany(VideoView::class, 'videoId');
    }

}
