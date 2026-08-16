<?php

namespace App\Http\Controllers;

use App\Models\School;
use App\Models\SupportRecord;
use Illuminate\Http\Request;

class SupportRecordController extends Controller
{
    public function create() {
        $schools = School::orderBy('name')->get();

        return view('registro', compact('schools'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'school_id' => ['required', 'exists:schools,id'],
            'profile' => ['required', 'string'],
            'module' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        SupportRecord::create([
            'school_id' => $validated['school_id'],
            'profile' => $validated['profile'],
            'module' => $validated['module'],
            'description' => $validated['description'],
            'status' => 'open',
        ]);

        return redirect('/dashboard')->with('success', 'Registro criado com sucesso!');
    }
}
