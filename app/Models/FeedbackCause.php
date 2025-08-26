<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedbackCause extends Model
{
    /** @use HasFactory<\Database\Factories\FeedbackCauseFactory> */
    use HasFactory;

    public function statuses()
    {
        return $this->hasMany(FeedbackStatus::class);
    }
}
