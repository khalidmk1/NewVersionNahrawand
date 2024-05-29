<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Domain extends Model
{
    use HasFactory;

    /**
     * Get all of the category for the Domain
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function category(): HasMany
    {
        return $this->hasMany(Category::class, 'domainId');
    }
}
