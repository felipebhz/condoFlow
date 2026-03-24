<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Apartment\ApartmentResource;
use Illuminate\Http\Request;
use App\Services\ApartmentService;
use App\Http\Requests\Apartment\StoreApartmentRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use App\DTOs\Apartment\UpdateApartmentDTO;
use App\Http\Requests\Apartment\UpdateApartmentRequest;
use App\Models\Apartment;

class ApartmentController extends Controller
{
    public function __construct(private readonly ApartmentService $apartmentService) {}

    public function index(): AnonymousResourceCollection
    {
        $apartments = $this->apartmentService->paginate();
        return ApartmentResource::collection($apartments);
    }

    public function store(StoreApartmentRequest $storeApartamentRequest)
    {
        $apartmentDTO = $storeApartamentRequest->toDTO();
        $apartment = $this->apartmentService->createForUser($apartmentDTO);
        return new ApartmentResource($apartment);
    }

    public function update(UpdateApartmentRequest $updateApartmentRequest, Apartment $apartment)
    {
        //$apartmentToUpdate = $updateApartmentRequest->apartment;
        $apartmentDTO = $updateApartmentRequest->toDTO($apartment);
        $updatedApartment = $this->apartmentService->update($apartment, $apartmentDTO);
        return new ApartmentResource($updatedApartment);
    }

    public function destroy(Apartment $apartment)
    {
        $this->apartmentService->delete($apartment);
        return response()->json(null, 204);
    }
}
