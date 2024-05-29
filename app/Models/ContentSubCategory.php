<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContentSubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'contentId',
        'subCategoryId'
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
     * Get the user that owns the SubCategoryObjevtiveContent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'contentId');
    }

      /**
     * Get the subCategory that owns the SubCategoryContent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'subCategoryId');
    }

     
}
