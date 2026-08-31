<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <title>Support Pocket - App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white m-0 p-0 font-sans antialiased">

<div class="max-w-md mx-auto h-screen flex flex-col justify-center px-8 relative shadow-lg overflow-hidden border-x border-gray-100">

    <div class="text-center mb-12">
        <div class="w-24 h-24 mx-auto mb-6 shadow-xl rounded-3xl overflow-hidden">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-full h-full">
                <rect width="512" height="512" rx="128" fill="#2563eb" />

                <!-- Ponto de notificação Vertical -->
                <circle cx="410" cy="130" r="28" fill="#60a5fa" />

                <!-- Letra S -->
                <path d="M210 180 H 150 A 40 40 0 0 0 110 220 V 230 A 40 40 0 0 0 150 270 H 190 A 40 40 0 0 1 230 310 V 320 A 40 40 0 0 1 190 360 H 110"
                      fill="none" stroke="#ffffff" stroke-width="44" stroke-linecap="round" stroke-linejoin="round" />

                <!-- Letra P -->
                <path d="M290 360 V 180 H 340 A 60 60 0 0 1 340 300 H 290"
                      fill="none" stroke="#ffffff" stroke-width="44" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Support Pocket</h1>
        <p class="text-gray-500 mt-2 font-medium">Gestão de Atendimento</p>
    </div>

    <form action="{{ route('login.store') }}" method="POST" class="space-y-5" novalidate>
        @csrf

        <div>
            <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">E-mail corporativo</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="nome@empresa.com.br"
                class="w-full bg-gray-100 border-0 rounded-2xl px-5 py-4 text-gray-800 focus:ring-2 focus:ring-blue-500 outline-none transition-all text-lg"
                required
            >
            @error('email')
                <p class="mt-2 ml-1 text-sm font-semibold text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="relative mt-5">
            <label class="block text-sm font-bold text-gray-700 mb-2 ml-1">Senha</label>

            <input
                type="password"
                id="campoSenha"
                name="password"
                placeholder="Digite sua senha"
                class="w-full bg-gray-100 border-0 rounded-2xl px-5 py-4 pr-12 text-gray-800 focus:ring-2 focus:ring-blue-500 outline-none transition-all text-lg"
                required
            >
            @error('password')
                <p class="mt-2 ml-1 text-sm font-semibold text-red-600">{{ $message }}</p>
            @enderror

            <button type="button" onclick="alternarSenha()" class="absolute right-4 top-11 text-gray-500 hover:text-blue-600 focus:outline-none">

                <!-- Olho Cortado -->
                <svg id="iconeFechado" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                </svg>

                <!-- Olho Aberto -->
                <svg id="iconeAberto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 hidden">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </button>
        </div>

        <div class="pt-6">
            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-2xl shadow-lg transition-all active:scale-95 text-xl focus:outline-none focus:ring-4 focus:ring-blue-500 focus:ring-offset-2">
                Entrar
            </button>
        </div>
    </form>

    <div class="mt-8 text-center">
        <a href="#" class="text-blue-600 text-sm font-bold underline underline-offset-2 hover:text-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded-sm transition-colors">
            Esqueci minha senha
        </a>
    </div>
</div>

<script>
    function alternarSenha() {
        const input = document.getElementById('campoSenha');
        const iconeFechado = document.getElementById('iconeFechado');
        const iconeAberto = document.getElementById('iconeAberto');

        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }

        iconeFechado.classList.toggle('hidden');
        iconeAberto.classList.toggle('hidden');
    }
</script>

</body>
</html>
