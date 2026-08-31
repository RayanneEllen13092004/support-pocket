@extends('layout')

@section('content')
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">

    <div class="max-w-md mx-auto min-h-screen bg-white shadow-lg overflow-hidden border-x border-slate-200 pb-24">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 pt-10 pb-8 rounded-b-3xl shadow-md">
            <h1 class="text-3xl font-bold mt-1">Municípios</h1>
            <p class="text-blue-100 mt-2 text-sm">Consulte matrizes e regras de atendimento</p>

            <div class="mt-5 flex justify-center">
                <div class="bg-white/15 rounded-2xl py-3 px-8 text-center shadow-sm w-full max-w-xs border border-white/10">
                    <p class="text-xs uppercase tracking-widest text-blue-100 font-semibold mb-1">Total de Municípios Ativos</p>
                    <div class="flex items-center justify-center gap-2 mt-1">
                       <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6 text-blue-200">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                        </svg>
                        <p class="font-extrabold text-3xl">{{ $municipalities->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="mt-4 relative">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">🔎</span>
                <input
                    type="text"
                    id="searchInput"
                    placeholder="Buscar município..."
                    class="w-full rounded-xl text-gray-800 border-0 pl-10 pr-4 py-3 outline-none shadow-sm focus:ring-2 focus:ring-blue-300 transition-all"
                >
            </div>
        </div>

        <div class="px-4 py-5" id="municipiosList">
            <div class="grid grid-cols-2 gap-3">
                @forelse($municipalities as $municipality)
                    <a
                        href="{{ route('municipios.show', $municipality->id) }}"
                        class="municipio-card relative bg-slate-50 p-4 rounded-2xl shadow-sm border border-slate-200 hover:shadow-md transition-all cursor-pointer overflow-hidden flex flex-col justify-between min-h-[112px]"
                        data-name="{{ strtolower($municipality->name) }}"
                    >
                        <div class="absolute top-0 left-0 w-full h-1 {{ $municipality->anchor_instructions ? 'bg-red-500' : 'bg-blue-500' }}"></div>

                        <div>
                            <h3 class="font-bold text-slate-800 text-sm mb-2 leading-tight">{{ $municipality->name }}</h3>

                            @if($municipality->anchor_instructions)
                                <span class="inline-flex items-center gap-1 bg-red-50 text-red-600 text-[10px] px-2 py-1 rounded-md font-bold">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-600"></span> Âncora
                                </span>
                            @endif
                        </div>

                        <div class="mt-3 pt-2 border-t border-slate-200">
                            <p class="text-[11px] font-bold text-blue-600 flex items-center gap-1">
                                Ver detalhes <span class="text-lg leading-none">&rsaquo;</span>
                            </p>
                        </div>
                    </a>
                @empty
                    <div class="col-span-2 text-center py-10 bg-slate-50 rounded-2xl border border-slate-200">
                        <p class="text-slate-500 text-sm">Nenhum município cadastrado no banco de dados.</p>
                    </div>
                @endforelse
            </div>

            <div id="empty-search" class="hidden text-center py-10 bg-slate-50 rounded-2xl border border-slate-200 mt-3">
                <p class="text-slate-500 text-sm">Nenhum município encontrado para esta busca.</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const cards = document.querySelectorAll('.municipio-card');
            const emptySearch = document.getElementById('empty-search');

            if (searchInput) {
                searchInput.addEventListener('keyup', function (event) {
                    const term = event.target.value.toLowerCase();
                    let visibleCards = 0;

                    cards.forEach(card => {
                        const name = card.getAttribute('data-name');

                        if (name.includes(term)) {
                            card.style.display = 'flex';
                            visibleCards += 1;
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    if (emptySearch) {
                        emptySearch.classList.toggle('hidden', visibleCards > 0 || term.length === 0);
                    }
                });
            }
        });
    </script>
@endsection
