<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class HoldingUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check(); 
    }
    
    public function rules(): array
    {
        return [
            'limit' => ['required','integer', 'min:100'],
        ];
    }
}
