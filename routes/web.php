<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WebSocialAuthController;

Route::get('/auth/{provider}/redirect', [WebSocialAuthController::class, 'redirect'])->name('social.redirect');
Route::get('/auth/{provider}/callback', [WebSocialAuthController::class, 'callback']);

Route::get('/', function () {
    return ('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tasks', [TaskController::class, "index"])->name("tasks.index");
    Route::get("/tasks/create", [TaskController::class, "create"])->name("tasks.create");
    Route::post("/tasks", [TaskController::class, "store"])->name("tasks.store");
    Route::get("/tasks/{task}", [TaskController::class, "show"])->name("tasks.show");
    Route::get("/tasks/{task}/edit", [TaskController::class, "edit"])->name("tasks.edit");
    Route::put("/tasks/{task}", [TaskController::class, "update"])->name("tasks.update");
    Route::post("/tasks/{task}/restore", [TaskController::class, "restore"])->name("tasks.restore");
    Route::delete("/tasks/{task}", [TaskController::class, "destroy"])->name("tasks.destroy");
    Route::delete("/tasks/{task}/force", [TaskController::class, "forceDelete"])->name("tasks.forceDelete");

    Route::post('/tasks/{task}/comments', [CommentController::class, 'store'])->name('tasks.comments.store');
});

require __DIR__ . '/auth.php';
