<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubCategory extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'categoryId',
        'avatar',
        'name',
        'description'
    ];

    /**
     * Get the category that owns the SubCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }

    /**
     * Get all of the objectives for the SubCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function objectives(): HasMany
    {
        return $this->hasMany(Objective::class, 'subCategoryId');
    }

    

      /**
     * Get all of the contentSubCategories for the SubCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contentSubCategories(): HasMany
    {
        return $this->hasMany(ContentSubCategory::class, 'subCategoryId');
    }
}
