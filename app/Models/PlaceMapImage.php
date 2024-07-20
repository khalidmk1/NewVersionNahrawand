<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlaceMapImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'imageId',
        'image'
    ];

    /**
     * Get the imagemap that owns the PlaceMapImage
     *
     * @return BelongsTo
     */
    public function imageMap(): BelongsTo
    {
        return $this->belongsTo(MapImages::class, 'imageId');
    }
}
