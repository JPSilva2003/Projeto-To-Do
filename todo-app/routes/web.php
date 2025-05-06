<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarefaController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\IdiomaCsvController;




Route::get('/', function () {
    return view('welcome'); // welcome.blade.php usa o layout base.blade.php
})->name('home');


Route::post('/tarefas', [TarefaController::class, 'store'])->name('tarefas.store');
Route::delete('/tarefas/{tarefa}', [TarefaController::class, 'destroy'])->name('tarefas.destroy');
Route::put('/tarefas/{tarefa}', [TarefaController::class, 'update'])->name('tarefas.update');
Route::get('/tarefas/{tarefa}/edit', [TarefaController::class, 'edit'])->name('tarefas.edit');
Route::patch('/tarefas/{tarefa}/concluir', [\App\Http\Controllers\TarefaController::class, 'concluir'])->name('tarefas.concluir');
Route::resource('tarefas', TarefaController::class);
Route::get('/idiomas/exportar/{locale}', [IdiomaCsvController::class, 'export'])->name('idiomas.exportar');
Route::post('/idiomas/importar', [IdiomaCsvController::class, 'import'])->name('idiomas.importar');
Route::view('/idiomas/gestao', 'idiomas.gestao')->name('idiomas.gestao');
Route::get('/idiomas', [IdiomaController::class, 'index'])->name('idiomas.index');




Route::get('lang/change/{locale}', [LanguageController::class, 'change'])->name('lang.change');



