<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Support Pocket</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 m-0 p-0 font-sans antialiased">

@yield('content')

<div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-md bg-white border-t border-gray-200 px-6 py-3">
    <div class="flex justify-between text-sm font-semibold text-gray-500">
        <a href="/dashboard" class="{{ Request::is('dashboard') ? 'text-blue-600' : '' }}">Home</a>
        <a href="/municipios" class="{{ Request::is('municipios*') ? 'text-blue-600' : '' }}">Municípios</a>
        <a href="/snippets" class="{{ Request::is('snippets*') ? 'text-blue-600' : '' }}">Snippets</a>
        <a href="/kanban" class="{{ Request::is('kanban*') ? 'text-blue-600' : '' }}">Kanban</a>
        <a href="/registro" class="{{ Request::is('registro*') ? 'text-blue-600' : '' }}">Registro</a>
    </div>
</div>

{{-- Modal de Aceite de Termos (LGPD) --}}
@if(auth()->check() && is_null(auth()->user()->terms_accepted_at))
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/75 backdrop-blur-sm p-4">
        <div class="bg-white rounded-3xl max-w-sm w-full p-6 shadow-2xl border border-slate-200">
            <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>

            <h2 class="text-xl font-bold text-slate-900">Termos de Armazenamento de Dados</h2>

            <div class="mt-3 text-sm text-slate-600 space-y-2 max-h-48 overflow-y-auto pr-1">
                <p>Para continuar utilizando o <strong>Support Pocket</strong>, leia e concorde com nossa política de dados em conformidade com a LGPD:</p>
                <p><strong>Onde seus dados são salvos:</strong> Suas credenciais de acesso, registros de atendimento, snippets e tarefas do Kanban são armazenados de forma criptografada em banco de dados <strong>PostgreSQL</strong> hospedado em servidor institucional controlado.</p>
                <p><strong>Seus direitos:</strong> Você pode solicitar ou executar a exclusão permanente da sua conta e dos seus dados pessoais a qualquer momento através do painel.</p>
            </div>

            <form action="{{ route('perfil.acceptTerms') }}" method="POST" class="mt-5">
                @csrf
                <label class="flex items-start gap-2.5 text-xs text-slate-700 cursor-pointer mb-4">
                    <input type="checkbox" required class="mt-0.5 rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                    <span>Li e concordo com o armazenamento e tratamento dos meus dados conforme descrito acima.</span>
                </label>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-xl transition shadow-md">
                    Aceitar e Continuar
                </button>
            </form>
        </div>
    </div>
@endif

</body>
</html>
