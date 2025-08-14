<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Badwords implements ValidationRule
{
    // List of disallowed/bad words
    protected array $badWords = [
        'fuck',
        'bitch',
        'whore',
        'nigga',
        'gay',  
        'dick',
        'sex',
        'porn'
    ];
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $valueLower = strtolower($value);

        foreach ($this->badWords as $badWord) {
            if (str_contains($valueLower, $badWord)) {
                $fail('The :attribute contains inappropriate language.');
                return;
            }
        }
    }
}
