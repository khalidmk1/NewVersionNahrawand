<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    ContentController,
    EventController,
    FAQController,
    ProfileController,
    ProgramController,
    QuizController,
    SubCategoryController,
    TicketController,
    VideoController,
    ObjectiveController
};
use App\Http\Controllers\Auth\{
    AuthenticatedSessionController,
    PasswordController,
    RegisteredUserController
};

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

// User Routes (Authenticated)
Route::middleware('auth:sanctum')->group(function () {
    // Authentication and Profile
    Route::prefix('user')->group(function () {
        Route::get('/', function (Request $request) {
            return $request->user();
        });
        Route::post('logout', [AuthenticatedSessionController::class, 'destroyApi'])->name('logout');
        Route::post('update/password', [PasswordController::class, 'updateApi'])->name('update.password');
        Route::post('profile/avatar/update', [ProfileController::class, 'updateAvatar'])->name('avatar.update');
        Route::post('update/profile', [ProfileController::class, 'updateApi'])->name('user.update');
        Route::get('client', [ProfileController::class, 'authUser'])->name('user.index');
        Route::get('subCategory', [ProfileController::class, 'allUserSubctegory'])->name('user.subcategory.index');
        Route::post('subcategory/create/{subCategoryId}', [ProfileController::class, 'createUserSubCategory'])->name('user.subcategory.create');
    });

    // Content
    Route::prefix('content')->group(function () {
        Route::post('create/favoris/{content}', [ContentController::class, 'createFavoris'])->name('favoris.create');
        Route::get('check/{content}', [ContentController::class, 'favorisExists'])->name('content.check');
        Route::post('create/finishedContent/{content}', [ContentController::class, 'createFinished'])->name('contentFinished.create');
        Route::post('create/commentContent/{content}', [ContentController::class, 'createComment'])->name('commentContent.create');
        Route::get('comment/{content}', [ContentController::class, 'contentComment'])->name('content.comment');
        Route::post('create/viewContent/{content}', [ContentController::class, 'createView'])->name('contentView.create');
        Route::get('check/finished/{content}', [ContentController::class, 'checkFinished'])->name('contentFinished.check');
    });

    // Objective
    Route::prefix('objective')->group(function (){
        Route::post('create/{subCategoryId}', [ObjectiveController::class, 'store'])->name('objective.store');
    });

    // Video
    Route::prefix('video')->group(function () {
        Route::post('create/view/{video}', [VideoController::class, 'createView'])->name('videoView.create');
        Route::post('note/create/{videoId}', [VideoController::class, 'noteCreate'])->name('note.create');
    });

    // Miscellaneous
    Route::get('favoris', [ContentController::class, 'favoris'])->name('favoris.index');
    Route::get('views', [ContentController::class, 'views'])->name('views.index');
    Route::get('content/finished', [ContentController::class, 'finishedContent'])->name('content.finished');
    Route::get('ticket', [TicketController::class, 'index'])->name('ticket.index');
    Route::post('ticket/create', [TicketController::class, 'create'])->name('ticket.create');
    Route::post('quiz/store/{contentId}/{quizId}', [QuizController::class, 'storeQuestionAnswer'])->name('quiz.store');
});

// Public Routes
Route::prefix('content')->group(function () {
    Route::get('/', [ContentController::class, 'allContent'])->name('content');
    Route::get('coming', [ContentController::class, 'comingSoonContent'])->name('content.coming');
    Route::get('formation', [ContentController::class, 'contentFormation'])->name('content.formation');
    Route::get('podcast', [ContentController::class, 'contentPodcast'])->name('content.podcast');
    Route::get('quickly', [ContentController::class, 'contentQuickly'])->name('content.quickly');
    Route::get('program/{programId}', [ContentController::class, 'contentByProgram'])->name('content.program');
    Route::get('qsm/{contentId}', [QuizController::class, 'qsmIndexContent'])->name('content.qsm');
    Route::get('qsm/question/{contentId}', [QuizController::class, 'qsmIndexContentQuestion'])->name('content.qsm.question');
});

Route::get('video/{video}', [VideoController::class, 'showVideo'])->name('video.index');
Route::get('event', [EventController::class, 'eventIndex'])->name('event.index');
Route::get('program', [ProgramController::class, 'allProgramApi'])->name('program.index');
Route::get('populaire', [ProfileController::class, 'populaire'])->name('user.populaire');
Route::get('speakers', [ProfileController::class, 'speakersAll'])->name('user.speakers');
Route::get('FAQ', [FAQController::class, 'FAQIndex'])->name('FAQ.index');
Route::get('subCategory/domain', [SubCategoryController::class, 'subCategoryByDomain'])->name('subCategory.domain');

// Authentication
Route::post('create/user', [RegisteredUserController::class, 'storeClient'])->name('user.create');
Route::post('login', [AuthenticatedSessionController::class, 'storeApi'])->name('user.login');
