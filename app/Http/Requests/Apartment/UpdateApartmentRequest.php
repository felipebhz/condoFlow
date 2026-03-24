<?php

declare(strict_types=1);

namespace App\Http\Requests\Apartment;

use App\DTOs\Apartment\UpdateApartmentDTO;
use App\Models\Apartment;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

final class UpdateApartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->is_active;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $routeParam = $this->route('apartments');
        $apartment = $routeParam instanceof \App\Models\Apartment ? $routeParam : \App\Models\Apartment::findOrFail($routeParam);
        $condominiumId = $this->user()->condominium_id;

        $blockToCheck = $this->has('block') ? $this->validated('block') : $apartment->block;

        return [
            'block' => ['sometimes', 'required', 'string', 'max:10'],
            'number' => [
                'sometimes',
                'required',
                'string',
                'max:20',
                Rule::unique('apartments', 'number')
                    ->where('condominium_id', $condominiumId)
                    ->where('block', $blockToCheck)
                    ->whereNull('deleted_at')
                    ->ignore($apartment),
            ],
            'parking_spot_limit' => ['sometimes', 'required', 'integer', 'min:0', 'max:10'],
        ];
    }

    public function messages(): array
    {
        return [
            'number.unique' => 'Este número de apartamento já existe neste bloco.',
        ];
    }

    public function toDTO(Apartment $apartment): UpdateApartmentDTO
    {
        return new UpdateApartmentDTO(
            block: $this->has('block') ? $this->validated('block') : $apartment->block,
            number: $this->has('number') ? $this->validated('number') : $apartment->number,
            parkingSpotLimit: $this->has('parking_spot_limit') ?
                (int) $this->validated('parking_spot_limit') : $apartment->parking_spot_limit,
        );
    }
}
