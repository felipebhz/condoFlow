<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Apartment\ApartmentResource;
use Illuminate\Http\Request;
use App\Services\ApartmentService;
use App\Http\Requests\Apartment\StoreApartmentRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ApartmentController extends Controller
{
    public function __construct(private readonly ApartmentService $apartmentService) {}

    public function index(): AnonymousResourceCollection
    {
        $apartments = $this->apartmentService->paginate();
        return ApartmentResource::collection($apartments);
    }

    public function store(StoreApartmentRequest $request)
    {
        $apartmentDTO = $request->toDTO();
        $apartment = $this->apartmentService->createForUser($apartmentDTO);
        return new ApartmentResource($apartment);
    }
}
