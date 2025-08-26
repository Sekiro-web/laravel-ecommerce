<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    /** @use HasFactory<\Database\Factories\FeedbackFactory> */
    use HasFactory;

    public function FeedbackStatus()
    {
        return $this->belongsTo(FeedbackStatus::class);
    }

    public function FeedbackCause()
    {
        return $this->belongsTo(FeedbackCause::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
