<?php

namespace App\Models;

use Spatie\Tags\HasTags;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Program extends Model
{
    use HasFactory , HasTags , SoftDeletes;

    protected $fillable = [
        'title',
        'description'
    ];

     

    /**
     * Get all of the programcategory for the Program
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function programcategory(): HasMany
    {
        return $this->hasMany(ProgramCategory::class, 'programId');
    }

    /**
     * Get all of the content for the Program
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function content(): HasMany
    {
        return $this->hasMany(Content::class, 'programId');
    }

}
