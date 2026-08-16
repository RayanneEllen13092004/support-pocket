@extends('layout')

@section('content')
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">

    <div class="max-w-md mx-auto min-h-screen bg-white shadow-lg overflow-hidden border-x border-slate-200 pb-24">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 pt-10 pb-8 rounded-b-3xl shadow-md">
            <h1 class="text-3xl font-bold mt-1">Municípios</h1>
            <p class="text-blue-100 mt-2 text-sm">Consulte matrizes e regras de atendimento</p>

            <div class="mt-5 grid grid-cols-2 gap-2 text-center">
                <div class="bg-white/15 rounded-xl p-2">
                    <p class="text-[11px] uppercase tracking-wide text-blue-100">Cadastrados</p>
                    <p class="font-bold text-lg">{{ $municipalities->count() }}</p>
                </div>
                <div class="bg-white/15 rounded-xl p-2">
                    <p class="text-[11px] uppercase tracking-wide text-blue-100">Com Âncora</p>
                    <p class="font-bold text-lg">{{ $municipalities->whereNotNull('anchor_instructions')->count() }}</p>
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
