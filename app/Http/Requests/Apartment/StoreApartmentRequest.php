<?php

declare(strict_types=1);

namespace App\Http\Requests\Apartment;

use App\DTOs\Apartment\StoreApartmentDTO;
use App\Models\Apartment;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class StoreApartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Apartment::class);
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'block' => ['required', 'string', 'max:10'],
            'number' => [
                'required',
                'string',
                'max:20',
                Rule::unique('apartments')->where(fn ($query) =>
                                            $query->where('block', $this->block)
                                            ->where('condominium_id', $this->user()->condominium_id)
                ),
            ],
            'parking_spot_limit' => ['required', 'integer', 'min:0', 'max:10'],
        ];
    }

    public function messages(): array
    {
        return [
            'number.unique' => 'Este número de apartamento já existe neste bloco.',
        ];
    }

    public function toDTO(): StoreApartmentDTO
    {
        return new StoreApartmentDTO(
            block: $this->validated('block'),
            number: $this->validated('number'),
            parkingSpotLimit: (int) $this->validated('parking_spot_limit'),
        );
    }
}
