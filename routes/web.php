<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('admin/', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');



// Middleware per la verifica di autenticazione
// prefix per admin/.. nell'url del browser
// name per il nome della rotta
Route::middleware(['auth', 'verified'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('projects', ProjectController::class)->parameters(['project' => 'project:slug']);
    });

require __DIR__ . '/auth.php';
