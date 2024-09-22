<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Auth;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Protected Routes: Only authenticated users can access these routes
// Route::middleware('auth:sanctum')->group(function () {
    // Retrieve all tasks
    // Route::middleware('auth:sanctum')->group(function () {
        Route::middleware(['Api_Auth'])->group(function () {
        Route::post('/tasks', [TaskController::class, 'store']); // Create task
        Route::put('/tasks/{id}', [TaskController::class, 'update']); // Update task
        Route::get('/tasks', [TaskController::class, 'index']); // Get all tasks
        Route::delete('/tasks/{id}', [TaskController::class, 'destroy']); // Delete task
        Route::get('tasks/filter', [TaskController::class, 'filter']);

    });

    Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('user_login');

    
// });

// Test route to get authenticated user
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


?>