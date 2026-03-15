<?php

declare(strict_types=1);

namespace App\Http\Resources\Apartment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read \App\Models\Apartment $resource
 */
final class ApartmentResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->resource->id,
            'block' => $this->resource->block,
            'number' => $this->resource->number,
            'parking_spot_limit' => (int) $this->resource->parking_spot_limit,
        ];
    }
}
