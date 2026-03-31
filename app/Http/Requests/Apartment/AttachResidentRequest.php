<?php
declare(strict_types=1);

namespace App\Http\Requests\Apartment;

use Illuminate\Foundation\Http\FormRequest;

class AttachResidentRequest extends FormRequest
{
    /**
     * Determina se o usuário está autorizado a fazer essa requisição.
     */
    public function authorize(): bool
    {
        // Retornamos true porque quem faz o bloqueio de acesso (403) 
        // é o pacote Spatie Laravel Permission lá no arquivo de rotas (ou construtor), 
        // checando se o usuário tem a role 'sindico'.
        // Quando a requisição chega aqui, ela já foi autorizada pelo segurança da porta.
        return true; 
    }

    /**
     * Regras de validação que serão aplicadas aos dados.
     */
    public function rules(): array
    {
        // Quem faz a validação e devolve o erro 422 (Unprocessable Entity) 
        // automaticamente caso falhe é o próprio core do Laravel (Illuminate\Validation).
        return [
            'user_id' => ['required', 'integer', 'exists:users,id'],
            'is_owner' => ['sometimes', 'boolean']
        ];
    }
    
    /**
     * (Opcional) Mensagens amigáveis para o Front-end.
     * Quem faz o mapeamento é o FormRequest nativo do Laravel.
     */
    public function messages(): array
    {
        return [
            'user_id.exists' => 'O usuário informado não foi encontrado no sistema.',
        ];
    }
}