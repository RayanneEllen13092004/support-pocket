<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Api\KanbanController;
use App\Http\Controllers\Api\MunicipalityController;
use App\Http\Controllers\Api\SupportRecordController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/kanban', [KanbanController::class, 'index']);
    Route::post('/kanban', [KanbanController::class, 'store']);
    Route::patch('/kanban/{id}/status', [KanbanController::class, 'updateStatus']);
    Route::put('/kanban/{id}', [KanbanController::class, 'update']);
    Route::delete('/kanban/{id}', [KanbanController::class, 'destroy']);

    Route::get('/municipios', [MunicipalityController::class, 'index']);
    Route::get('/municipios/{id}', [MunicipalityController::class, 'show']);
    Route::post('/municipios', [MunicipalityController::class, 'store']);
    Route::put('/municipios/{id}', [MunicipalityController::class, 'update']);
    Route::delete('/municipios/{id}', [MunicipalityController::class, 'destroy']);
    Route::post('/municipios/{id}/documentos', [MunicipalityController::class, 'uploadDocument']);
    Route::delete('municipios/{municipioId}/documentos/{documentId}', [App\Http\Controllers\Api\MunicipalityController::class, 'deleteDocument']);

    Route::get('/schools', [SupportRecordController::class, 'schools']);
    Route::post('/registro', [SupportRecordController::class, 'store']);

    Route::put('/perfil/senha', [ProfileController::class, 'updatePassword']);
    Route::post('/perfil/aceitar-termos', [ProfileController::class, 'acceptTerms']);
    Route::delete('/perfil/excluir-conta', [ProfileController::class, 'destroyAccount']);
});
