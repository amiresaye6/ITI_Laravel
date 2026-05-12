<?php

// use App\Http\Controllers\Api\SocialAuthController;
use App\Http\Controllers\Api\TaskController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->name('api.')->group(function () {

    Route::apiResource('tasks', TaskController::class);

});

Route::post('/login', function (Request $request) {
    $request->validate(['email' => 'required|email', 'password' => 'required']);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // Generates the Sanctum Token!
    return response()->json(['token' => $user->createToken('api-token')->plainTextToken]);
});

// Social Login Routes
// Route::get('auth/{provider}/redirect', [SocialAuthController::class, 'redirectToProvider']);
// Route::get('auth/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback']);