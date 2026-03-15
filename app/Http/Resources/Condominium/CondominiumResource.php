<?php

namespace App\Http\Resources\Condominium;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property-read \App\Models\Condominium $resource
 */
class CondominiumResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (int) $this->resource->id,
            'name' => $this->resource->name,
            'taxId' => $this->resource->tax_id,
            'address' => $this->resource->address,
        ];
    }
}
