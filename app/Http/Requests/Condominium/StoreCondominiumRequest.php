<?php

declare(strict_types=1);

namespace App\Http\Requests\Condominium;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\DTOs\Condominium\StoreCondominiumDTO;

class StoreCondominiumRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->isSuperAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'tax_id' => ['required', 'string', 'max:18'],
            'address' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function toDto(): StoreCondominiumDTO
    {
        return new StoreCondominiumDTO(
            $this->validated('name'),
            $this->validated('tax_id'),
            $this->validated('address'),
        );
    }
}
