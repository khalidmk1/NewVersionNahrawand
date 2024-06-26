<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quiz extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'contentId',
        'videoId',
        'question',
    ];


    /**
     * Get the content that owns the Quiz
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'contentId');
    }

    /**
     * Get the video that owns the Quiz
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function video(): BelongsTo
    {
        return $this->belongsTo(ContentVideo::class, 'videoId');
    }

    /**
     * Get all of the answers for the Quiz
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(QuizAnswer::class, 'quizId');
    }
 
    /**
     * Get all of the quizParameter for the Quiz
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function quizParameter(): HasMany
    {
        return $this->hasMany(QuizPrameter::class, 'quizId');
    } 

    public function rightAnswer()
    {
        return $this->hasOneThrough(
            QuizAnswer::class,
            QuizPrameter::class,
            'quizId', // Foreign key on QuizPrameter
            'id', // Foreign key on QuizAnswer
            'id', // Local key on Quiz
            'answerId' // Local key on QuizPrameter
        );
    }

}
