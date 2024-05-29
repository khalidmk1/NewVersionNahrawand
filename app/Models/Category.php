<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'domainId',
        'name'
    ];

    /**
     * Get the domain that owns the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function domain(): BelongsTo
    {
        return $this->belongsTo(Domain::class, 'domainId');
    }

    /**
     * Get all of the subcategory for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subcategory(): HasMany
    {
        return $this->hasMany(SubCategory::class, 'categoryId');
    }

    /**
     * Get all of the programcategory for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programcategory(): HasMany
    {
        return $this->hasMany(ProgramCategory::class, 'categoryId');
    }

    /**
     * Get all of the content for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function content(): HasMany
    {
        return $this->hasMany(Content::class, 'categoryId');
    }
   
}
