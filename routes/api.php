<?php

use App\Http\Controllers\TodoController;
use App\Models\User;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', function (Request $request) {
    $validated = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
    $user = User::where('email', $validated['email'])->first();
    if ($user && Hash::check($validated['password'], $user->password)) {
        $token = $user->createToken('login.basic');
        return ['token' => $token->plainTextToken];
    }
    return response()->json(['error' => 'user not found']);
});

Route::middleware(['auth:sanctum'])->get('/todo', [TodoController::class, 'index']);
Route::middleware(['auth:sanctum'])->get('/todo/{id}', [TodoController::class, 'get'])->where('id', '[0-9]+');
Route::middleware(['auth:sanctum'])->get('/todo/page', [TodoController::class, 'page']);
Route::middleware(['auth:sanctum'])->post('/todo', [TodoController::class, 'create']);
Route::middleware(['auth:sanctum'])->put('/todo/{id}', [TodoController::class, 'update']);
