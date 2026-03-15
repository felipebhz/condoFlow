<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Apartment\ApartmentResource;
use Illuminate\Http\Request;
use App\Services\ApartmentService;
use App\Http\Requests\Apartment\StoreApartmentRequest;

class ApartmentController extends Controller
{
    public function __construct(private readonly ApartmentService $apartmentService) {}

    public function store(StoreApartmentRequest $request)
    {
        $apartmentDTO = $request->toDTO();
        $apartment = $this->apartmentService->createForUser($apartmentDTO);
        return new ApartmentResource($apartment);
    }
}
