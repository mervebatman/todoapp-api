<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TodoController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/todos', function() {
//     return 'this is todo api cınım';
// });

Route::get('todos', [TodoController::class, 'getTodos']);
Route::post('todo', [TodoController::class, 'createTodo']);
Route::get('todos/{id}', [TodoController::class, 'showTodo']);
Route::put('todos/{id}/update', [TodoController::class, 'updateTodo']);
Route::delete('todos/{id}/delete', [TodoController::class, 'deleteTodo']);
