<?php

namespace App\Http\Requests\Message;

use App\Models\Message;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MessageStoreRequest extends FormRequest
{

    public function authorize(): bool{
        return true;
    }

    public function rules(): array{
        return [
            'message'      => ['required','string', 'max:500'],
            'uuid'         => ['required','string', 'max:50']
        ];
    }

}
