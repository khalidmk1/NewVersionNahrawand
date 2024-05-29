<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VideoGuest extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'VideoId',
        'userId'
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
     * Get the user that owns the VideoGuest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }

    /**
     * Get the video that owns the VideoGuest
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function video(): BelongsTo
    {
        return $this->belongsTo(ContentVideo::class, 'VideoId');
    }

} 
