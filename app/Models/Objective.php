<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Objective extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'subCategoryId',
        'name'
    ];


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'subCategoryId' => 'array',
    ];


    /**
     * Get the subcategory that owns the Objective
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'subCategoryId');
    }

    /**
     * Get all of the objectives for the Objective
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contentObjectives(): HasMany
    {
        return $this->hasMany(ContentObjective::class, 'objectivelId');
    }


}
