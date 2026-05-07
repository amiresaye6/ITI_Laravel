<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

// i can use this one to make the 7 routes at once :__:
// Route:get("/", [TaskController::class, "index"])->name('tasks.index');

//     method, route, controller,       method to run,  name we can use in the frontend to call same route.
Route::get('/tasks', [TaskController::class, "index"])->name("tasks.index");

Route::get("/tasks/create", [TaskController::class, "create"])->name("tasks.create");
Route::post("/tasks", [TaskController::class, "store"])->name("tasks.store");

Route::get("/tasks/{task}", [TaskController::class, "show"])->name("tasks.show");

Route::get("/tasks/{task}/edit", [TaskController::class, "edit"])->name("tasks.edit");
Route::put("/tasks/{task}", [TaskController::class, "update"])->name("tasks.update");

Route::delete("/tasks/{task}", [TaskController::class, "destroy"])->name("tasks.destroy");