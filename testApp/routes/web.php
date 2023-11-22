<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\LecturerController;
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
Route::get('/coba', [CobaController::class, 'coba']);
Route::view('/contoh', 'contoh');
Route::name('user.')
        ->prefix('user')
        ->group( function () {
            Route::get('/welcome', function () {
                return view('sample.welcome');
            });
        });

// Route::view('/test', 'test');

route::get('/test/{name?}/{kelas}', function ($name = null) {
    if ($name == null) {
        return "Selamat datang...";
    } else {
        return "Selamat datang ".$name;
    }
})->name('test');

// route('test', ['finsa', 'kelas-a']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => ['role:admin|user']], function () {
    Route::get('/data', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('data');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::name('lecturer.')
        ->prefix('lecturer')
        ->group( function () {
            Route::get('/', [LecturerController::class, 'index'])->name('index');
            Route::get('/create', [LecturerController::class, 'create'])->name('create');
            Route::post('/store', [LecturerController::class, 'store'])->name('store');
        });

require __DIR__.'/auth.php';
