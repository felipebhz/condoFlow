<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Condominium\StoreCondominiumRequest;
use App\Http\Resources\Condominium\CondominiumResource;
use App\Services\CondominiumService;
use Illuminate\Http\Request;

class CondominiumController extends Controller
{

    public function __construct(
        private readonly CondominiumService $condominiumService
    ) {}

    public function store(StoreCondominiumRequest $request)
    {
        $condominiumDto = $request->toDTO();
        $condominium = $this->condominiumService->createForUser($condominiumDto);

        return new CondominiumResource($condominium);
    }
}
