<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Rules\FileIsYamlRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRoutineRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'routine' => ['required', 'file', new FileIsYamlRule()],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
