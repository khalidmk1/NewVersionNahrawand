<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuizAnswerQuestion extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'contentId',
        'userId',
        'quizId',
        'answer'
    ];

    /**
     * Get the content that owns the QuizAnswerQuestion
     *
     * @return BelongsTo
     */
    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'contentId');
    }

    /**
     * Get the user that owns the QuizAnswerQuestion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'userId');
    }

    /**
     * Get the quiz that owns the QuizAnswerQuestion
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'quizId');
    }
}
