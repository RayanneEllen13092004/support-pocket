<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function acceptTerms(Request $request)
    {
        $user = $request->user();
        $user->terms_accepted_at = now();
        $user->save();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Termos de armazenamento aceitos com sucesso!',
                'terms_accepted_at' => $user->terms_accepted_at,
            ], 200);
        }

        return redirect()->back()->with('success', 'Termos de uso aceitos com sucesso!');
    }

    public function destroyAccount(Request $request)
    {
        $user = $request->user();

        if (method_exists($user, 'tokens')) {
            $user->tokens()->delete();
        }

        if (!$request->expectsJson()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        $user->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Conta excluída permanentemente.'
            ], 200);
        }

        return redirect('/login')->with('success', 'Sua conta foi excluída permanentemente.');
    }
}
