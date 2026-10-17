<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;

class KanbanController extends Controller
{
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get();

        $kanban = [
            'todo' => $tasks->where('status', 'todo')->values(),
            'doing' => $tasks->where('status', 'doing')->values(),
            'done' => $tasks->where('status', 'done')->values(),
        ];

        return response()->json($kanban, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $task = Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'status' => 'todo'
        ]);

        return response()->json(['task' => $task], 201);
    }

    public function updateStatus(Request $request, $id)
    {
        $task = Task::where('id', $id)->where('user_id', Auth::id())->first();
        if (!$task) {
            return response()->json(['message' => 'Tarefa não encontrada'], 404);
        }

        $request->validate([
            'status' => 'required|in:todo,doing,done'
        ]);

        $task->update(['status' => $request->status]);

        return response()->json(['success' => true, 'task' => $task], 200);
    }

    public function update(Request $request, $id)
    {
        $tarefa = Task::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$tarefa) {
            return response()->json(['message' => 'Tarefa não encontrada ou sem permissão.'], 404);
        }

        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $tarefa->title = $request->title;
        $tarefa->save();

        return response()->json(['message' => 'Tarefa atualizada com sucesso!', 'tarefa' => $tarefa], 200);
    }

    public function destroy($id)
    {
        $tarefa = Task::where('id', $id)->where('user_id', Auth::id())->first();

        if (!$tarefa) {
            return response()->json(['message' => 'Tarefa não encontrada ou sem permissão.'], 404);
        }

        $tarefa->delete();

        return response()->json(['message' => 'Tarefa excluída com sucesso!'], 200);
    }
}
