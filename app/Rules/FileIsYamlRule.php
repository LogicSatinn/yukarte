<?php

declare(strict_types=1);

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class FileIsYamlRule implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ('yaml' !== $value->getClientOriginalExtension()) {
            $fail('The :attribute must be a YAML file.');
        }
    }
}
