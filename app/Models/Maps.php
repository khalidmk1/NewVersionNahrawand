<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Maps extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'att',
        'lang',
        'title',
        'slogan',
        'image',
        'date',
        'founder',
        'description'
    ];

    /**
     * Get all of the images for the Maps
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(MapImages::class, 'mapId')->with('imagePlace');
    }
}
