@extends('layout')

@section('content')
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">

    <div class="max-w-md mx-auto min-h-screen bg-white shadow-lg overflow-hidden border-x border-slate-200 pb-24">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 pt-10 pb-8 rounded-b-3xl shadow-md">
            <p class="text-sm text-blue-100">Bom dia, suporte</p>
            <h1 class="text-3xl font-bold mt-1">Support Pocket</h1>
            <p class="text-blue-100 mt-2 text-sm">Visão rápida do atendimento escolar</p>

            <div class="mt-5 grid grid-cols-3 gap-2 text-center">
                <div class="bg-white/15 rounded-xl p-2">
                    <p class="text-[11px] uppercase tracking-wide text-blue-100">Hoje</p>
                    <p class="font-bold text-lg">30</p>
                </div>
                <div class="bg-white/15 rounded-xl p-2">
                    <p class="text-[11px] uppercase tracking-wide text-blue-100">Abertos</p>
                    <p class="font-bold text-lg">12</p>
                </div>
                <div class="bg-white/15 rounded-xl p-2">
                    <p class="text-[11px] uppercase tracking-wide text-blue-100">SLA</p>
                    <p class="font-bold text-lg">92%</p>
                </div>
            </div>
        </div>

        @if (session('success'))
            <div id="alerta-sucesso" class="fixed top-10 left-1/2 transform -translate-x-1/2 w-[calc(100%-3rem)] max-w-sm z-50 rounded-xl bg-emerald-100 p-4 text-emerald-800 border border-emerald-200 shadow-2xl flex justify-between items-center transition-opacity duration-500 ease-in-out">
                <div>
                    <strong class="font-bold">Sucesso!</strong>
                    <span class="block text-sm mt-1">{{ session('success') }}</span>
                </div>

                <button onclick="document.getElementById('alerta-sucesso').remove()" class="text-green-700 hover:text-green-900 text-xl font-bold px-2">
                    &times;
                </button>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    setTimeout(function() {
                        const alerta = document.getElementById('alerta-sucesso');
                        if (alerta) {
                            alerta.classList.add('opacity-0');
                            setTimeout(function(){
                                alerta.remove();
                            }, 500);
                        }
                    }, 3000);
                });
            </script>
        @endif

        <div class="px-4 pt-5 space-y-4">
            <div class="grid grid-cols-2 gap-3">
                <div class="bg-white rounded-2xl p-4 border border-slate-200 shadow-sm">
                    <p class="text-xs text-slate-500">Chamados hoje</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">30</p>
                    <p class="text-xs text-emerald-600 mt-1">+8% vs ontem</p>
                </div>

                <div class="bg-white rounded-2xl p-4 border border-slate-200 shadow-sm">
                    <p class="text-xs text-slate-500">Em aberto</p>
                    <p class="text-2xl font-bold text-slate-900 mt-1">12</p>
                    <p class="text-xs text-amber-600 mt-1">Atenção ao módulo Notas</p>
                </div>
            </div>

            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 shadow-sm">
                <p class="text-sm font-semibold text-amber-800">Alerta do dia</p>
                <p class="text-sm text-amber-700 mt-1">18 chamados (60%) foram sobre o módulo de Notas na rede estadual.</p>
            </div>

            <div class="bg-white rounded-2xl p-4 border border-slate-200 shadow-sm">
                <h2 class="text-lg font-bold text-slate-900 mb-3">Ações rápidas</h2>

                <div class="space-y-2">
                    <a href="/snippets" class="block bg-slate-100 hover:bg-slate-200 transition rounded-xl px-4 py-3 font-semibold text-slate-800">
                        Ver Snippets
                    </a>

                    <a href="/registro" class="block bg-slate-100 hover:bg-slate-200 transition rounded-xl px-4 py-3 font-semibold text-slate-800">
                        Novo Registro
                    </a>

                    <a href="/kanban" class="block bg-slate-100 hover:bg-slate-200 transition rounded-xl px-4 py-3 font-semibold text-slate-800">
                        Abrir Kanban
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-4 border border-slate-200 shadow-sm">
                <h2 class="text-sm font-bold text-slate-800 mb-3 uppercase tracking-wide">Distribuição por módulo</h2>
                <div class="space-y-2 text-sm">
                    <div>
                        <div class="flex justify-between text-slate-600 mb-1"><span>Notas</span><span>60%</span></div>
                        <div class="h-2 rounded-full bg-slate-100"><div class="h-2 rounded-full bg-blue-500 w-3/5"></div></div>
                    </div>
                    <div>
                        <div class="flex justify-between text-slate-600 mb-1"><span>Frequência</span><span>25%</span></div>
                        <div class="h-2 rounded-full bg-slate-100"><div class="h-2 rounded-full bg-indigo-500 w-1/4"></div></div>
                    </div>
                    <div>
                        <div class="flex justify-between text-slate-600 mb-1"><span>Boletim</span><span>15%</span></div>
                        <div class="h-2 rounded-full bg-slate-100"><div class="h-2 rounded-full bg-emerald-500 w-[15%]"></div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
