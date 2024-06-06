<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\VideoController;
use App\Http\Controllers\Api\ContentController;
use App\Http\Controllers\Api\ProfileController;
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

    Route::get('client', [ProfileController::class, 'authUser'])->name('user.index');
    
    Route::post('create/favoris/{content}', [ContentController::class, 'createFavoris'])->name('favoris.create');
    Route::get('check/content/{content}', [ContentController::class, 'favorisExists'])->name('content.check');
    
    Route::post('create/finishedContent/{content}', [ContentController::class, 'createFinished'])->name('contentFinishe.create');

    Route::post('create/commentContent/{content}', [ContentController::class, 'createComment'])->name('commentContent.create');
    Route::get('content/comment/{content}', [ContentController::class, 'contentComment'])->name('content.comment');

    Route::post('create/viewContent/{content}', [ContentController::class, 'createView'])->name('contentView.create');

    Route::get('check/content/finished/{content}', [ContentController::class, 'checkFinished'])->name('contentFinished.check');

    Route::post('create/video/view/{video}', [VideoController::class, 'createView'])->name('videoView.create');

    Route::get('favoris', [ContentController::class, 'favoris'])->name('favoris.index');
    Route::get('views', [ContentController::class, 'views'])->name('views.index');
    Route::get('content/finished', [ContentController::class, 'finishedContent'])->name('content.finished');
});


Route::get('content', [ContentController::class, 'allContent'])->name('content');
Route::get('content/coming', [ContentController::class, 'comingSoonContent'])->name('content.coming');
Route::get('content/formation', [ContentController::class, 'contentFormation'])->name('content.formation');
Route::get('content/podcast', [ContentController::class, 'contentPodcast'])->name('content.podcast');
Route::get('content/quickly', [ContentController::class, 'contentQuicly'])->name('content.quickly');

Route::get('video/{video}', [VideoController::class, 'showVideo'])->name('video.index');

Route::get('event', [EventController::class, 'eventIndex'])->name('event.index');

Route::get('populaire', [ProfileController::class, 'populaire'])->name('user.populaire');

Route::post('create/user', [RegisteredUserController::class, 'storeClient'])->name('user.create');
Route::post('login', [AuthenticatedSessionController::class, 'storeApi'])->name('user.login');
