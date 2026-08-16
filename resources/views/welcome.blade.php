<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Support Pocket - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 m-0 p-0 font-sans antialiased">

<div class="max-w-md mx-auto min-h-screen bg-white shadow-lg overflow-hidden border-x border-gray-100">
    <div class="bg-blue-600 text-white px-6 pt-10 pb-6 rounded-b-3xl">
        <p class="text-sm opacity-80">Bom dia, suporte</p>
        <h1 class="text-2xl font-bold mt-1">Support Pocket</h1>
        <p class="text-blue-100 mt-2 text-sm">Resumo do atendimento</p>
    </div>

    <div class="p-6 space-y-4">
        <div class="grid grid-cols-2 gap-4">
            <div class="bg-slate-50 rounded-2xl p-4 shadow-sm">
                <p class="text-xs text-gray-500">Chamados hoje</p>
                <p class="text-2xl font-bold text-gray-900">30</p>
            </div>
            <div class="bg-slate-50 rounded-2xl p-4 shadow-sm">
                <p class="text-xs text-gray-500">Em aberto</p>
                <p class="text-2xl font-bold text-gray-900">12</p>
            </div>
        </div>

        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4">
            <p class="text-sm font-semibold text-amber-800">Alerta</p>
            <p class="text-sm text-amber-700 mt-1">18 chamados foram do módulo de Notas.</p>
        </div>

        <div>
            <h2 class="text-lg font-bold text-gray-900 mb-3">Ações rápidas</h2>
            <div class="space-y-3">
                <a href="/snippets" class="block bg-gray-100 rounded-2xl px-4 py-4 font-semibold text-gray-800">Ver Snippets</a>
                <a href="/registro" class="block bg-gray-100 rounded-2xl px-4 py-4 font-semibold text-gray-800">Novo Registro</a>
            </div>
        </div>
    </div>

    <div class="fixed bottom-0 left-1/2 -translate-x-1/2 w-full max-w-md bg-white border-t border-gray-200 px-6 py-3">
        <div class="flex justify-between text-sm font-semibold text-gray-500">
            <a href="/dashboard" class="text-blue-600">Home</a>
            <a href="/snippets">Snippets</a>
            <a href="/registro">Registro</a>
        </div>
    </div>
</div>

</body>
</html>
