<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QuizPrameter extends Model
{
    use HasFactory , SoftDeletes;
    
    protected $fillable = [
        'contentId',
        'videoId',
        'quizId',
        'answerId',
        'rate',
        'count'
    ];

    /**
     * Get the quiz that owns the QuizPrameter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class, 'quizId');
    }

    /**
     * Get the content that owns the QuizPrameter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function content(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'contentId');
    }

    /**
     * Get the answer that owns the QuizPrameter
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rightAnswer(): BelongsTo
    {
        return $this->belongsTo(QuizAnswer::class, 'answerId');
    }

  
    

}
