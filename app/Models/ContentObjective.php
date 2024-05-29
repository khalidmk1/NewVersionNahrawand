<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ContentObjective extends Model
{
    use HasFactory;

    protected $fillable = [
        'contentId',
        'objectivelId',
       
    ];

     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'objectivelId' => 'array',
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
     * Get the user that owns the SubCategoryObjevtiveContent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function objective(): BelongsTo
    {
        return $this->belongsTo(Objective::class, 'objectivelId');
    }
}
