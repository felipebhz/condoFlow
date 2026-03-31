<?php 
declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
// 1. Importamos o nosso escudo de validação recém-criado
use App\Http\Requests\Apartment\AttachResidentRequest; 
use Illuminate\Http\JsonResponse;

class ApartmentResidentController extends Controller
{
    // Quem faz a injeção automática dessa classe (Service) no construtor 
    // é o Service Container (IoC) nativo do Laravel.
    public function __construct(protected \App\Services\ResidentService $residentService)
    {
    }

    // Trocamos o "Request $request" genérico pelo nosso "AttachResidentRequest" tipado.
    // Quem faz o "Bind" do $apartment (buscando no banco pelo ID da URL) 
    // é o Route Model Binding nativo do Laravel.
    public function store(AttachResidentRequest $request, Apartment $apartment): JsonResponse
    {
        // 1. Se o código chegou nesta linha, é porque o AttachResidentRequest 
        // já validou tudo perfeitamente. O Controller está 100% seguro.

        // 2. Passa a bola para o Service processar a regra de negócio no banco.
        // Quem extrai os dados limpos e seguros da requisição é o método validated() do Laravel.
        $this->residentService->attachResident(
            $apartment, 
            $request->validated('user_id'), 
            $request->validated('is_owner', false) // Pega o boolean, ou false como fallback
        );

        // 3. Retorna Sucesso com Status 201 (Created)
        // Quem monta essa resposta HTTP formatada é o helper response() do framework.
        return response()->json([
            'message' => 'Morador vinculado com sucesso.'
        ], 201);
    }
}