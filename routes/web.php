<?php

use App\Http\Controllers\kurikulumController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\roleController;
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

//Route::get('/', function () {
//    return view('welcome');
//});
//
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get("mk", [MataKuliahController::class, 'index'])->name('mk-index');
Route::get('mk-create', [MataKuliahController::class, 'create'])->name('mk-create');
Route::post('mk-store', [MataKuliahController::class, 'store'])->name('mk-store');

Route::get("role", [roleController::class, 'index'])->name('role-index');
Route::get("role-create", [roleController::class, 'create'])->name('role-create');
Route::post("role-store", [roleController::class, 'store'])->name('role-store');

Route::get("kurikulum", [kurikulumController::class, 'index'])->name('kurikulum-index');
Route::get("kurikulum-create", [kurikulumController::class, 'create'])->name('kurikulum-create');
Route::post("kurikulum-store", [kurikulumController::class, 'store'])->name('kurikulum-store');

Route::get('/', function () {
    return view('home');
});
