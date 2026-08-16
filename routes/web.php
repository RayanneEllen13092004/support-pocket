<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SupportRecordController;
use App\Models\Municipality;
use App\Http\Controllers\SnippetController;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/login', [LoginController::class, 'show'])->name('login');

Route::post('/login', [LoginController::class, 'store'])->name('login.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/municipios', function () {
    $municipalities = Municipality::orderBy('name')->get();
    return view('municipios', compact('municipalities'));
})->name('municipios');

Route::get('/municipios/{id}', function ($id) {
   $municipality = Municipality::findOrFail($id);
   return view('municipios-detalhes', compact('municipality'));
})->name('municipios.show');

Route::get('/snippets', [SnippetController::class, 'index'])->name('snippets.index');

Route::post('/snippets', [SnippetController::class, 'store'])->name('snippets.store');

Route::get('/registro', [SupportRecordController::class, 'create'])->name('registro.create');
Route::post('/registro', [SupportRecordController::class, 'store'])->name('registro.store');

Route::get('/kanban', [TaskController::class, 'index'])->middleware('auth')->name('kanban');
Route::post('/kanban', [TaskController::class, 'store'])->name('kanban.store');
Route::patch('/kanban/{task}/status', [TaskController::class, 'updateStatus'])->name('kanban.updateStatus');
