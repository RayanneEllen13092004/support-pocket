@extends('layout')

@section('content')
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">

<div class="max-w-md mx-auto min-h-screen bg-white shadow-lg overflow-hidden border-x border-slate-200 pb-24">
    <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 pt-10 pb-7 rounded-b-3xl shadow-md relative">
        <a href="{{ route('municipios') }}" class="inline-flex items-center text-blue-100 hover:text-white mb-4 transition-colors bg-white/10 px-3 py-1.5 rounded-lg">
            <span class="text-xl mr-2 leading-none">&lsaquo;</span> Voltar
        </a>
        <h1 class="text-3xl font-bold">{{ $municipality->name }}</h1>
        <p class="text-blue-100 mt-1 text-sm">Visão geral e regras operacionais da rede</p>
        <div class="mt-3">
            @if($municipality->anchor_instructions)
                <span class="inline-flex items-center gap-1 bg-red-500/20 border border-red-200/30 text-red-100 text-[11px] px-2 py-1 rounded-full font-semibold">
                    <span class="w-1.5 h-1.5 rounded-full bg-red-200"></span> Possui regras de âncora
                </span>
            @else
                <span class="inline-flex items-center gap-1 bg-emerald-500/20 border border-emerald-200/30 text-emerald-100 text-[11px] px-2 py-1 rounded-full font-semibold">
                    Sem regras de âncora
                </span>
            @endif
        </div>
    </div>

    <div class="px-4 mt-5 space-y-4">

        @if($municipality->anchor_instructions)
            <div class="bg-red-50 rounded-2xl shadow-sm border border-red-200 overflow-hidden">
                <div class="bg-red-50 px-4 py-3 border-b border-red-100 flex items-center gap-2">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 rounded-full bg-red-600"></div>
                        <h2 class="font-bold text-red-800 text-sm uppercase tracking-wide">Instruções do Âncora</h2>
                    </div>

                    @if(auth()->user()->role === 'supervisor')
                        <button class="text-red-700 font-bold text-xs hover:underline">Editar</button>
                    @endif
                </div>

                <div class="p-4">
                    <p class="text-red-900 text-sm leading-relaxed whitespace-pre-line">{{ $municipality->anchor_instructions }}</p>
                </div>
            </div>
        @endif

        <!-- Matriz Curricular -->
        <div class="bg-slate-50 rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="bg-slate-100 px-4 py-3 border-b border-slate-200 flex items-center gap-2">
                <div class="w-2 h-2 rounded-full bg-blue-500"></div>
                <h2 class="font-bold text-slate-700 text-sm uppercase tracking-wide">Matriz Curricular</h2>
            </div>

            <div class="p-4">
                <p class="text-slate-700 text-sm leading-relaxed whitespace-pre-line">{{ $municipality->curriculum_matrix ?? 'Nenhuma matriz cadastrada.' }}</p>
            </div>
        </div>

        <!-- Anexos e Documentos -->
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden opacity-75">
            <div class="bg-slate-50 px-4 py-3 border-b border-slate-200">
                <h2 class="font-bold text-slate-700 text-sm uppercase tracking-wide flex items-center gap-2">
                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                    </svg>Anexos e Documentos
                </h2>

                @if(auth()->user()->role === 'supervisor')
                    <form action="{{ route('municipios.documentos', $municipality->id) }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2">
                        @csrf
                        <input type="file" name="arquivo" required
                               class="text-xs text-slate-500
                                file:mr-2 file:py-1 file:px-3 file:rounded-full file:border-0
                                file:text-[10px] file:font-bold file:uppercase file:tracking-wide file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100 file:cursor-pointer cursor-pointer">

                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs px-3 py-1.5 rounded-lg transition-colors">
                                    Enviar
                            </button>
                    </form>
                @endif

                <div class="p-4 space-y-2">
                    @forelse($municipality->documents as $document)
                        <div class="flex items-center justify-between p-3 bg-slate-50 rounded-xl border border-slate-200 hover:border-slate-300 transition-colors">
                            <div class="flex items-center gap-2 overflow-hidden">
                                <span class="text-base">📄</span>
                                <span class="text-xs text-slate-700 font-medium truncate max-w-[180px]" title="{{ $document->name }}">
                                    {{ $document->name }}
                                </span>
                            </div>

                            <a href="{{ asset('storage/' . $document->path) }}" target="_blank" download="{{ $document->name }}">
                                <span>Baixar</span>⬇️
                            </a>
                        </div>
                    @empty
                        <p class="text-slate-400 text-xs italic text-center py-2">Nenhum arquivo anexado.</p>
                    @endforelse
                </div>
            </div>

            <div class="p-4 text-center">
                <p class="text-slate-400 text-xs italic">Nenhum arquivo anexado a este município.</p>
            </div>
        </div>

    </div>
</div>
@endsection
