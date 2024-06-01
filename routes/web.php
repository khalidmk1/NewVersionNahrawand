<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\GlobaleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ObjectiveController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ContentVideoController;
use App\Http\Controllers\GuestProfileController;
use App\Http\Controllers\RolePermissionController;

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

/* Route::get('/', function () {
    return view('welcome');
}); */


Route::middleware(['auth'  , 'verified'])->prefix('/dashboard')->group(function () {
    Route::get('objectives/{id}', [GlobaleController::class, 'objectivesByCategory'])->name('objective.category');
    Route::get('admin', [GlobaleController::class, 'indexAdmin'])->name('index.admin');
    Route::get('manager', [GlobaleController::class, 'indexManager'])->name('index.manager');
    Route::get('speaker', [GlobaleController::class, 'indexSpeaker'])->name('index.speaker');
    Route::get('admin/create', [GlobaleController::class, 'createAdmin'])->name('create.admin');
    Route::get('manager/create', [GlobaleController::class, 'createManager'])->name('create.manager');
    Route::get('speaker/create', [GlobaleController::class, 'createSpeaker'])->name('create.speaker');
    Route::delete('delete/video/{id}', [GlobaleController::class, 'deletevideo'])->name('delete.video');
});


Route::middleware(['auth' , 'verified'])->prefix('/dashboard')->group(function () {
    Route::get('/', [ReportController::class, 'index'])->name('report.index');
    Route::resource('role', RolePermissionController::class);
    Route::post('role/{roleId}/{permissionId}', [RolePermissionController::class, 'storeRolePermission'])->name('store.role.permission');

    Route::resource('category', CategoryController::class);
    Route::resource('subcategory', SubCategoryController::class);
    Route::resource('program', ProgramController::class);
    Route::resource('objective', ObjectiveController::class);
    Route::resource('content', ContentController::class);
    Route::resource('video', ContentVideoController::class);
    Route::resource('event', EventController::class);
    Route::resource('FAQ', FAQController::class);
    Route::resource('email', EmailController::class);

   
   

});

Route::middleware('auth')->group(function () {
    Route::post('/profile/store', [GuestProfileController::class, 'store'])->name('profile.store');
    Route::get('/profile/{id}', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
