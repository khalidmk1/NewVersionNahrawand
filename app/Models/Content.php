<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Content extends Model
{
    use HasFactory , HasTags , SoftDeletes;

    protected $fillable = [
        'categoryId',
        'hostId',
        'programId',
        'image',
        'imageFlex',
        'video',
        'title',
        'bigDescription',
        'smallDescription',
        'contentType',
        'quizType',
        'isActive',
        'isComing',
        'isCertify',
        'pricing',
        'isUpdated',
        'isDelete',
        'document',
        'condition',
        'duration'
    ];


    /**
     * Get the user that owns the Content
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'hostId');
    }

    /**
     * Get the program that owns the Content
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class, 'programId');
    }

    /**
     * Get the category that owns the Content
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'categoryId');
    }

    /**
     * Get all of the videos for the Content
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videos(): HasMany
    {
        return $this->hasMany(ContentVideo::class, 'contentId');
    }

    /**
     * Get all of the subCategories for the Content
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contentSubCategories(): HasMany
    {
        return $this->hasMany(ContentSubCategory::class, 'contentId');
    }

    /**
     * Get all of the objectives for the Content
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contentObjectives(): HasMany
    {
        return $this->hasMany(ContentObjective::class, 'contentId');
    }

    /**
     * Get all of the favoris for the Content
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function favoris(): HasMany
    {
        return $this->hasMany(ContentFavoris::class, 'contentId');
    }

    /**
     * Get all of the views for the Content
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function views(): HasMany
    {
        return $this->hasMany(ContentView::class, 'contentId');
    }

    /**
     * Get all of the finished for the Content
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function finished(): HasMany
    {
        return $this->hasMany(ContentFinished::class, 'contentId');
    }

}
 