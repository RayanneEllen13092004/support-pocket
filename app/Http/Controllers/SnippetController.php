<?php


namespace App\Http\Controllers;

use App\Models\Snippet;
use Illuminate\Http\Request;

class SnippetController extends Controller
{
    public function index() {
        $snippets = Snippet::orderby('title')->get();

        return view('snippets', compact('snippets'));
    }

    public function store(\Illuminate\Http\Request $request) {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'body' => ['required', 'string'],
        ]);

        \App\Models\Snippet::create($data);

        return redirect()->route('snippets.index');
    }
}
