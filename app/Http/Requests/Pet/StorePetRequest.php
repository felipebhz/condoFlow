<?php

namespace App\Http\Requests\Pet;

use App\Enums\PetSize;
use App\Enums\PetSpecies;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePetRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'species' => ['required', 'string', Rule::enum(PetSpecies::class)],
            'breed' => ['nullable', 'string', 'max:100'],
            'size' => ['required', 'string', Rule::enum(PetSize::class)],
            'photo_path' => ['nullable', 'string', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'species.Illuminate\Validation\Rules\Enum' => 'A espécie informada é inválida.',
            'size.Illuminate\Validation\Rules\Enum' => 'O porte do animal informado é inválido.',
        ];
    }
}
