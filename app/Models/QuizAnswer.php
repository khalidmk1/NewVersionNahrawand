<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuizAnswer extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable = [
        'quizId',
        'Answer',
    ];

    /**
     * Get the quiz that owns the QuizAnswer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'quizId');
    }

    /**
     * Get the rightAnswer associated with the QuizAnswer
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function rightAnswer(): HasOne
    {
        return $this->hasOne(QuizPrameter::class, 'answerId');
    }
}
