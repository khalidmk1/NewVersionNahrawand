<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserObjective extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'subCategoryId',
        'name',
        'date'
    ];

    /**
     * Get the user that owns the UserSubcategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }

    /**
     * Get the subCategory that owns the UserSubcategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'subCategoryId');
    }
}
