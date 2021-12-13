<?php

use Illuminate\Support\Facades\Route;
use App\Models\Todo;
use Illuminate\Http\Request;
use App\Http\Controllers\TodoController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     $todos = Todo::orderBy('created_at', 'DESC')->get();
//     return view('welcome', ['todos' => $todos]);
// })->name('todos.index');
Route::get('/', [TodoController::class, 'list'])->name('todos.index');
Route::post('/todo', function(Request $request) {
    $newTodo = new Todo();
    $newTodo->body = $request->todo_body;
    $newTodo->save();
    return redirect()->route('todos.index');
})->name('todo.store');
