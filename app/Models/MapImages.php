<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MapImages extends Model
{
    use HasFactory ;

    protected $fillable = [
        'mapId',
        'type',
        'image',
        'description',
        'title',
        'adresse',
        'link'
    ];

    /**
     * Get the map that owns the MapImages
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function map(): BelongsTo
    {
        return $this->belongsTo(Maps::class, 'mapId');
    }

    /**
     * Get all of the imagePlace for the MapImages
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function imagePlace(): HasMany
    {
        return $this->hasMany(PlaceMapImage::class, 'imageId');
    }
}
