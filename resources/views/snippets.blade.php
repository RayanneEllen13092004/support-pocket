@extends('layout')

@section('content')
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">

<div class="max-w-md mx-auto min-h-screen bg-white shadow-lg overflow-hidden border-x border-gray-100">
    <div class="bg-blue-600 text-white px-6 pt-10 pb-6 rounded-b-3xl">
        <p class="text-sm opacity-80">Respostas rápidas</p>
        <h1 class="text-2xl font-bold mt-1">Snippets</h1>
    </div>

    <div class="p-6 space-y-4">
        @foreach($snippets as $snippet)
            <div class="bg-gray-100 rounded-2xl p-4 shadow-sm">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <h2 class="font-bold text-gray-900">{{ $snippet->title }}</h2>
                        <p class="text-xs text-gray-500 mt-1">{{ $snippet->category }}</p>
                    </div>

                    <button type="button"
                            class="copy-snippet bg-blue-600 text-white text-xs font-bold px-3 py-2 rounded-xl"
                            data-snippet="{{  $snippet->body }}">Copiar
                    </button>
                </div>

                <p class="text-sm text-gray-600 mt-3 whitespace-pre-line">
                    {{ $snippet->body }}
                </p>
            </div>
        @endforeach
    </div>
</div>

    <script>
        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('copy-snippet')) {
                const texto = event.target.getAttribute('data-snippet');

                navigator.clipboard.writeText(texto).then(function() {
                    event.target.innerText = 'Copiado!';
                    setTimeout(function() {
                        event.target.innerText = 'Copiar';
                    }, 1500);
                });
            }
        });
    </script>
@endsection
