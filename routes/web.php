<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TypeController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('projects/trash', [ProjectController::class, 'trash'])->name('projects.trash');
        Route::post("projects/restore/{project}", [ProjectController::class, "restore"])->withTrashed()->name('projects.restore');
        Route::delete("projects/def_destroy/{project}", [ProjectController::class, "defDestroy"])->withTrashed()->name('projects.def_destroy');
        Route::post("projects/restore_all", [ProjectController::class, "restoreAll"])->name('projects.restore_all');
        Route::resource('projects', ProjectController::class)->parameters(['projects' => 'project:slug']);
        Route::resource('types', TypeController::class)->parameters(['types' => 'type:slug']);
        Route::resource('technologies', TechnologyController::class)->parameters(['technologies' => 'technology:id']);
        Route::get('/show', [DashboardController::class, 'show'])->name('user_details.show');
        Route::get('/create', [DashboardController::class, 'create'])->name('user_details.create');
        Route::post('/store', [DashboardController::class, 'store'])->name('user_details.store');
        Route::get('/edit', [DashboardController::class, 'edit'])->name('user_details.edit');
        Route::put('/update', [DashboardController::class, 'update'])->name('user_details.update');
    });

require __DIR__ . '/auth.php';
