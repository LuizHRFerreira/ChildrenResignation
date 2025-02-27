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
            'value'             => ['required', 'int'],
            'start_date'        => ['required', 'string', 'max:255'],
            'end_date'          => ['required', 'string', 'max:255'],
            'descriptions'      => ['required','string', 'max:255'],
        ];
    }

    public function attributes(): array
    {
        return [
            'descriptions' => 'descrição',
            'name' => 'nome',
            'value' => 'valor',
            'start_date' => 'data inicial',
            'end_date' => 'data final',
            'descriptions' => 'descrição',
        ];
    }
}
