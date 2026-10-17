<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function updatePassword(Request $request)
    {
        $request->validate([
            'senha_atual' => 'required|string',
            'nova_senha' => 'required|string|min:6',
        ]);

        $user = $request->user();

        // 2. Verifica se a senha digitada bate com a senha criptografada do banco
        if (!Hash::check($request->senha_atual, $user->password)) {
            return response()->json([
                'message' => 'A senha atual está incorreta.'
            ], 400);
        }

        $user->password = Hash::make($request->nova_senha);
        $user->save();

        return response()->json([
            'message' => 'Senha atualizada com sucesso!'
        ], 200);
    }
}
