<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContentController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum'])->group(function () {
    
   
    Route::post('create/favoris/{content}', [ContentController::class, 'createFavoris'])->name('favoris.create');
    
});


Route::get('content', [ContentController::class, 'allContent'])->name('content');
Route::get('content/coming', [ContentController::class, 'comingSoonContent'])->name('content.coming');
Route::get('content/formation', [ContentController::class, 'contentFormation'])->name('content.formation');

Route::post('create/user', [RegisteredUserController::class, 'storeClient'])->name('user.create');
Route::post('login', [AuthenticatedSessionController::class, 'storeApi'])->name('user.login');
