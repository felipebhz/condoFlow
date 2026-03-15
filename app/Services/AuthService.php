<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

final class AuthService
{
    /**
     * @param array{email: string, password: string, device_name: ?string} $credentials
     * @throws ValidationException
     */
    public function authenticate(array $credentials): string
    {
        $user = User::where('email', $credentials['email'])->first();

        if (! $user || ! Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['As credenciais fornecidas são inválidas ou a conta está desativada.'],
            ]);
        }

        if (! $user->isSuperAdmin() && $user->condominium_id === null) {
            throw ValidationException::withMessages([
                'email' => ['Usuário sem condomínio vinculado. Entre em contato com o suporte.'],
            ]);
        }

        $deviceName = $credentials['device_name'] ?? 'web-browser';

        return $user->createToken($deviceName)->plainTextToken;
    }
}
