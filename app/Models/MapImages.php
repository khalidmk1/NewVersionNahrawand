<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MapImages extends Model
{
    use HasFactory ;

    protected $fillable = [
        'mapId',
        'type',
        'image',
        'description'
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
}
