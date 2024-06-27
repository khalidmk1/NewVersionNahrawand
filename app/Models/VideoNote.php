<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'videoId',
        'userId',
        'note',
    ];

    /**
     * Get the video that owns the VideoNote
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function video(): BelongsTo
    {
        return $this->belongsTo(ContentVideo::class, 'videoId');
    }

    /**
     * Get the user that owns the VideoNote
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
