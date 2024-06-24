<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    FAQController,
    EmailController,
    EventController,
    ReportController,
    TicketController,
    ContentController,
    GlobaleController,
    ProfileController,
    ProgramController,
    CategoryController,
    ObjectiveController,
    SubCategoryController,
    ContentVideoController,
    GuestProfileController,
    RolePermissionController,
    QuizController
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth', 'verified' ])->prefix('dashboard')->group(function () {
    // Admin/Manager/Speaker/Client Dashboards
    Route::get('admin', [GlobaleController::class, 'indexAdmin'])->name('index.admin');
    Route::get('manager', [GlobaleController::class, 'indexManager'])->name('index.manager');
    Route::get('speaker', [GlobaleController::class, 'indexSpeaker'])->name('index.speaker');
    Route::get('client', [GlobaleController::class, 'indexClient'])->name('client.index');
    Route::get('client/{id}', [ProfileController::class, 'show'])->name('client.show');

    // Restore Operations
    Route::post('content/restore/{content}', [ContentController::class, 'restore'])->name('content.restore');
    Route::post('video/restore/{video}', [ContentVideoController::class, 'restore'])->name('video.restore');
    Route::post('event/restore/{event}', [EventController::class, 'restore'])->name('event.restore');
    Route::post('category/restore/{category}', [CategoryController::class, 'restore'])->name('category.restore');
    Route::post('subCategory/restore/{subCategory}', [SubCategoryController::class, 'restore'])->name('subCategory.restore');
    Route::post('program/restore/{program}', [ProgramController::class, 'restore'])->name('program.restore');

    // Additional Routes
    Route::get('password/change', [GlobaleController::class, 'passwordChange'])->name('password.change');
    Route::get('objectives/{id}', [GlobaleController::class, 'objectivesByCategory'])->name('objective.category');
    Route::get('content/quickly', [GlobaleController::class, 'quicklyIndex'])->name('quickly.index');
    Route::get('history', [GlobaleController::class, 'history'])->name('history');
    Route::post('qsm/content/store/{id}', [GlobaleController::class, 'storeContentQsm'])->name('quiz.content.store');

    // Creation Routes
    Route::get('admin/create', [GlobaleController::class, 'createAdmin'])->name('create.admin');
    Route::get('manager/create', [GlobaleController::class, 'createManager'])->name('create.manager');
    Route::get('speaker/create', [GlobaleController::class, 'createSpeaker'])->name('create.speaker');

    // Delete Operation
    Route::delete('delete/video/{id}', [GlobaleController::class, 'deletevideo'])->name('delete.video');

    // Ticket Comment
    Route::post('ticket/comment/{id}', [GlobaleController::class, 'createComment'])->name('ticket.comment.create');

    // Reports
    Route::get('/', [ReportController::class, 'index'])->name('report.index');

    // Resources
    Route::resources([
        'role' => RolePermissionController::class,
        'category' => CategoryController::class,
        'subcategory' => SubCategoryController::class,
        'program' => ProgramController::class,
        'objective' => ObjectiveController::class,
        'content' => ContentController::class,
        'video' => ContentVideoController::class,
        'event' => EventController::class,
        'FAQ' => FAQController::class,
        'email' => EmailController::class,
        'ticket' => TicketController::class,
        'quiz' => QuizController::class,
    ]);

    // Custom Role-Permission Store
    Route::post('role/{roleId}/{permissionId}', [RolePermissionController::class, 'storeRolePermission'])->name('store.role.permission');
});

// Profile Management
Route::middleware('auth')->group(function () {
    Route::post('/profile/store', [GuestProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/restore/{user}', [ProfileController::class, 'restore'])->name('profile.restore');
});

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });
});

require __DIR__ . '/auth.php';
