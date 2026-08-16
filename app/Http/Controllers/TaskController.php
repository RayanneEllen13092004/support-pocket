<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller {
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get();

        $kanban = [
            'todo' => $tasks->where('status', 'todo'),
            'doing' => $tasks->where('status', 'doing'),
            'done' => $tasks->where('status', 'done'),
        ];

        return view('kanban', compact('kanban'));
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255'
        ]);

        Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'status' => 'todo'
        ]);

        return back();
    }

    public function updateStatus(Request $request, Task $task){
        if ($task->user_id !== Auth::id()) {
            return response()->json(['error' => 'Não autorizado'], 403);
        }

        $request->validate([
            'status' => 'required|in:todo,doing,done'
        ]);

        $task->update(['status' => $request->status]);

        return response()->json(['success' => true]);
    }
}
