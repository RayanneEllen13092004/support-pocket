<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\SupportRecord;
use Illuminate\Http\Request;

class SupportRecordController extends Controller
{
    public function schools()
    {
        $schools = School::orderBy('name')->get(['id', 'name']);

        return response()->json($schools, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'school_id' => ['required', 'exists:schools,id'],
            'profile' => ['required', 'string'],
            'module' => ['required', 'string'],
            'description' => ['required', 'string'],
        ]);

        $record = SupportRecord::create([
            'school_id' => $validated['school_id'],
            'profile' => $validated['profile'],
            'module' => $validated['module'],
            'description' => $validated['description'],
            'status' => 'open',
        ]);

        return response()->json([
            'message' => 'Registro criado com sucesso!',
            'record' => $record,
        ], 201);
    }
}
