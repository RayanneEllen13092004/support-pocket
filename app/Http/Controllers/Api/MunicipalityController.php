<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Municipality;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MunicipalityController extends Controller
{
    public function index()
    {
        $municipalities = Municipality::orderBy('name')->get(['id', 'name', 'anchor_instructions']);

        return response()->json($municipalities, 200);
    }

    public function show($id)
    {
        $municipality = Municipality::with('documents')->findOrFail($id);

        $documents = $municipality->documents->map(function (Document $document) {
            return [
                'id' => $document->id,
                'name' => $document->name,
                'path' => $document->path,
                'download_url' => asset(Storage::url($document->path)),
                'created_at' => $document->created_at,
            ];
        })->values();

        return response()->json([
            'id' => $municipality->id,
            'name' => $municipality->name,
            'anchor_instructions' => $municipality->anchor_instructions,
            'curriculum_matrix' => $municipality->curriculum_matrix,
            'documents' => $documents,
        ], 200);
    }

    public function store(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'anchor_instructions' => 'nullable|string'
        ]);

        $municipio = \App\Models\Municipality::create([
            'name' => $request->name,
            'anchor_instructions' => $request->anchor_instructions
        ]);

        return response()->json($municipio, 201);
    }

    public function update(\Illuminate\Http\Request $request, $id)
    {
        $municipio = \App\Models\Municipality::find($id);

        if (!$municipio) {
            return response()->json(['message' => 'Município não encontrado.'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'anchor_instructions' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        $municipio->update($request->all());

        return response()->json($municipio, 200);
    }

    public function destroy($id)
    {
        $municipio = \App\Models\Municipality::find($id);

        if (!$municipio) {
            return response()->json(['message' => 'Município não encontrado.'], 404);
        }

        $municipio->update(['is_active' => false]);

        return response()->json(['message' => 'Município desativado com sucesso.'], 200);
    }

    public function uploadDocument(Request $request, $id)
    {
        if ($request->user()->role !== 'supervisor') {
            return response()->json([
                'message' => 'Apenas supervisores podem anexar documentos.'
            ], 403);
        }

        $validated = $request->validate([
            'document' => ['required', 'file', 'max:5120'],
        ]);

        $municipality = Municipality::findOrFail($id);
        $file = $validated['document'];
        $path = $file->store('documentos', 'public');

        $document = Document::create([
            'municipality_id' => $municipality->id,
            'name' => $file->getClientOriginalName(),
            'path' => $path,
        ]);

        return response()->json([
            'message' => 'Documento enviado com sucesso.',
            'document' => [
                'id' => $document->id,
                'name' => $document->name,
                'path' => $document->path,
                'download_url' => asset(Storage::url($document->path)),
                'created_at' => $document->created_at,
            ],
        ], 201);
    }

    public function deleteDocument($municipioId, $documentId)
    {
        // 1. Busca o documento no banco de dados
        // Assumindo que o seu model se chama Document (ou ajuste para o nome real, ex: Anexo)
        $document = \App\Models\Document::find($documentId);

        if (!$document) {
            return response()->json(['message' => 'Documento não encontrado.'], 404);
        }

        // 2. (Opcional) Se você salva o arquivo fisicamente no storage, exclua-o:
        // if (\Illuminate\Support\Facades\Storage::disk('public')->exists($document->file_path)) {
        //     \Illuminate\Support\Facades\Storage::disk('public')->delete($document->file_path);
        // }

        // 3. Exclui o registo da base de dados
        $document->delete();

        return response()->json(['message' => 'Documento excluído com sucesso.'], 200);
    }
}
