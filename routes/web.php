<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TechnologyController;
use App\Http\Controllers\Admin\TypeController;
use App\Models\Technology;

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



// rotte Pubbliche (Guest)
Route::get('/', [PageController::class, 'index'])->name('home');




// rotte Private (Admin)
Route::middleware(['auth', 'verified'])
         ->prefix('admin')
         ->name('admin.')
         ->group(function() {

            // inserisco tutte le rotte Private protette da auth - anche CRUD
            Route::get('/', [DashboardController::class, 'index'])->name('home');
            Route::resource('projects', ProjectController::class);
            Route::resource('technologies', TechnologyController::class)->except(['show', 'create', 'edit']);

            // rotte custom
            Route::resource('types', TypeController::class)->except(['index', 'show', 'create', 'edit']);
            Route::get('technology-projects/{technology}', [TechnologyController::class, 'technologyProjects'] )->name('technology-projects');
            Route::get('type-project', [TypeController::class, 'typeProjects'])->name('type_project');
         });






// rotte Autenticazione
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
