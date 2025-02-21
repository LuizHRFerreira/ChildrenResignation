<?php

namespace App\Http\Requests\Example;

use App\Models\Example;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExampleStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'              => ['required', 'string', 'max:255'],
            'value'             => ['required', 'string', 'max:255'],
            'start_date'        => ['required', 'string', 'max:255'],
            'end_date'          => ['required', 'string', 'max:255'],
            'descriptions'      => ['required','string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório',
            'value.required' => 'O valor é obrigatório',
            'start_date.required' => 'A data inicial é obrigatória',
            'end_date.required' => 'A data final é obrigatória',
        ];
    }
}
