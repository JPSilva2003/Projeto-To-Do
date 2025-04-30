<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TarefaController;

Route::get('/', function () {
    return view('welcome'); // welcome.blade.php usa o layout base.blade.php
})->name('home');


Route::post('/tarefas', [TarefaController::class, 'store'])->name('tarefas.store');
Route::delete('/tarefas/{tarefa}', [TarefaController::class, 'destroy'])->name('tarefas.destroy');
Route::put('/tarefas/{tarefa}', [TarefaController::class, 'update'])->name('tarefas.update');
Route::get('/tarefas/{tarefa}/edit', [TarefaController::class, 'edit'])->name('tarefas.edit');
Route::patch('/tarefas/{tarefa}/concluir', [\App\Http\Controllers\TarefaController::class, 'concluir'])->name('tarefas.concluir');

Route::resource('tarefas', TarefaController::class);
