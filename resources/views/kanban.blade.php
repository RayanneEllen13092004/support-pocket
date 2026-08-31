@extends('layout')

@section('content')
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">

    <style>
        .kanban-ghost {
            opacity: .55;
            background: #dbeafe;
            border: 1px dashed #60a5fa;
        }

        .kanban-chosen {
            transform: scale(1.01);
        }

        .kanban-drag {
            cursor: grabbing;
        }
        </style>

    <div class="max-w-md mx-auto min-h-screen bg-white shadow-lg overflow-hidden border-x border-slate-200 pb-24 flex flex-col">

        <div class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 pt-10 pb-6 rounded-b-3xl shadow-md mb-6">
            <h1 class="text-2xl font-bold">Meu Kanban</h1>
            <p class="text-sm text-blue-100 mt-1">Organize seus chamados com arrastar e soltar</p>

            <form action="{{ route('kanban.store') }}" method="POST" class="flex gap-2 mt-4">
                @csrf
                <input
                   type="text"
                   name="title"
                   placeholder="Nova tarefa..."
                   required
                   class="flex-1 rounded-xl px-4 py-2 text-gray-800 outline-none focus:ring-2 focus:ring-blue-300 shadow-sm"
                >
                <button
                   type="submit"
                   class="bg-white text-blue-700 font-bold px-4 py-2 rounded-xl active:scale-95 transition-transform shadow-sm"
                >
                   + Adicionar
                </button>
            </form>
        </div>

        <div class="flex overflow-x-auto gap-4 px-4 pb-6 snap-x flex-1">

            <div class="w-[85vw] max-w-[280px] shrink-0 bg-white rounded-3xl border border-slate-200 p-4 snap-center shadow-sm flex flex-col">
                <div class="flex items-center justify-between mb-3 shrink-0">
                   <h2 class="text-xs font-bold uppercase tracking-wide text-slate-600">A Fazer</h2>
                   <span class="text-xs font-semibold bg-slate-100 text-slate-600 px-2 py-1 rounded-full">
                       {{ $kanban['todo']->count() }}
                   </span>
                </div>

                <div id="todo" class="space-y-3 min-h-[120px] kanban-col">
                   @forelse($kanban['todo'] as $task)
                       <div data-id="{{ $task->id }}" class="bg-slate-50 p-4 rounded-2xl border border-slate-200 shadow-sm cursor-grab active:cursor-grabbing hover:shadow-md transition">
                           <h3 class="font-semibold text-slate-800 text-sm">{{ $task->title }}</h3>
                       </div>
                   @empty
                       <div class="border-2 border-dashed border-slate-300 rounded-2xl p-4 text-xs text-slate-400 text-center">
                           Arraste tarefas para cá
                       </div>
                   @endforelse
                </div>
            </div>

            <div class="w-[85vw] max-w-[280px] shrink-0 bg-blue-50 rounded-3xl border border-blue-200 p-4 snap-center shadow-sm flex flex-col">
                <div class="flex items-center justify-between mb-3 shrink-0">
                   <h2 class="text-xs font-bold uppercase tracking-wide text-blue-700">Em andamento</h2>
                   <span class="text-xs font-semibold bg-blue-100 text-blue-700 px-2 py-1 rounded-full">
                       {{ $kanban['doing']->count() }}
                   </span>
                </div>

                <div id="doing" class="space-y-3 flex-1 kanban-col">
                   @forelse($kanban['doing'] as $task)
                       <div data-id="{{ $task->id }}" class="bg-slate-50 p-4 rounded-2xl border border-slate-200 shadow-sm cursor-grab active:cursor-grabbing hover:shadow-md transition">
                           <h3 class="font-semibold text-slate-800 text-sm">{{ $task->title }}</h3>
                       </div>
                   @empty
                       <div class="border-2 border-dashed border-blue-300 rounded-2xl p-4 text-xs text-blue-400 text-center">
                           Arraste tarefas para cá
                       </div>
                   @endforelse
                </div>
            </div>

            <div class="w-[85vw] max-w-[280px] shrink-0 bg-emerald-50 rounded-3xl border border-emerald-200 p-4 snap-center shadow-sm">
                <div class="flex items-center justify-between mb-3">
                   <h2 class="text-xs font-bold uppercase tracking-wide text-emerald-700">Concluído</h2>
                   <span class="text-xs font-semibold bg-emerald-100 text-emerald-700 px-2 py-1 rounded-full">
                       {{ $kanban['done']->count() }}
                   </span>
                </div>

                <div id="done" class="space-y-3 min-h-[120px] kanban-col">
                   @forelse($kanban['done'] as $task)
                       <div data-id="{{ $task->id }}" class="bg-white p-4 rounded-2xl border border-emerald-200 shadow-sm opacity-80 cursor-grab active:cursor-grabbing hover:shadow-md transition">
                           <h3 class="font-semibold text-slate-700 text-sm line-through">{{ $task->title }}</h3>
                       </div>
                   @empty
                       <div class="border-2 border-dashed border-emerald-300 rounded-2xl p-4 text-xs text-emerald-400 text-center">
                           Arraste tarefas para cá
                       </div>
                   @endforelse
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const columns = document.querySelectorAll('.kanban-col');

            columns.forEach(column => {
                new Sortable(column, {
                   group: 'shared',
                   animation: 180,
                   ghostClass: 'kanban-ghost',
                   chosenClass: 'kanban-chosen',
                   dragClass: 'kanban-drag',
                   onEnd: function (evt) {
                       const taskId = evt.item.getAttribute('data-id');
                       const newStatus = evt.to.id;

                       if (!taskId) return;

                       fetch(`/kanban/${taskId}/status`, {
                           method: 'PATCH',
                           headers: {
                               'Accept': 'application/json',
                               'Content-Type': 'application/json',
                               'X-CSRF-TOKEN': '{{ csrf_token() }}'
                           },
                            body: JSON.stringify({ status: newStatus })
                       }).then(response => response.json())
                         .then(data => {
                             if (data.success) {
                                 window.location.reload();
                             }
                         });
                   }
               });
           });
        })
    </script>
@endsection
