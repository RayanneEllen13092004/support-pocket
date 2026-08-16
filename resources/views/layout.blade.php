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

</body>
</html>
