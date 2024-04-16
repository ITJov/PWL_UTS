<?php

use App\Http\Controllers\adminController;
    use App\Http\Controllers\Auth\AuthenticatedSessionController;
    use App\Http\Controllers\kurikulumController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\pollingController;
use App\Http\Controllers\pollingDetailController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\roleController;
    use App\Http\Controllers\sesiController;
    use App\Http\Controllers\userController;
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
//
//
//
Route::get('home', function () {
    return redirect('home');
});

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/unauthorized', function () {
        return view('unauthorized');
    })->name('unauthorized');
    Route::get("logout", [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::middleware(['auth','userAkses:Admin'])->group(function () {
    //user
    Route::get("user", [userController::class, 'index'])->name('user-index');
    Route::get("user-create", [userController::class, 'create'])->name('user-create');
    Route::post("user-store", [userController::class, 'store'])->name('user-store');
    Route::get('user-edit/{pengguna}', [userController::class, 'edit'])->name('user-edit');
    Route::post('user-edit/{pengguna}', [userController::class, 'update'])->name('user-update');
    Route::get('user-delete/{pengguna}', [userController::class, 'destroy'])->name('user-delete');
    Route::get("addKurikulumUser/{pengguna}", [userController::class, 'addKurikulum'])->name('addKurikulumUser');
    Route::post('addKurikulumUser/{pengguna}', [userController::class, 'storeKurikulum'])->name('storeKurikulum');
    // role
    Route::get("role", [roleController::class, 'index'])->name('role-index');
    Route::get("role-create", [roleController::class, 'create'])->name('role-create');
    Route::post("role-store", [roleController::class, 'store'])->name('role-store');
    Route::get('role-edit/{role}', [roleController::class,'edit'])->name('role-edit');
    Route::post('role-edit/{role}', [roleController::class, 'update'])->name('role-update');
    Route::get('role-delete/{role}', [roleController::class, 'destroy'])->name('role-delete');

});

Route::middleware(['auth','userAkses:Prodi,Admin'])->group(function () {
    //kurikulum
    Route::get("kurikulum", [kurikulumController::class, 'index'])->name('kurikulum-index');
    Route::get("kurikulum-create", [kurikulumController::class, 'create'])->name('kurikulum-create');
    Route::post("kurikulum-store", [kurikulumController::class, 'store'])->name('kurikulum-store');
    Route::get('kurikulum-edit/{kurikulum}', [kurikulumController::class, 'edit'])->name('kurikulum-edit');
    Route::post('kurikulum-edit/{kurikulum}', [kurikulumController::class, 'update'])->name('kurikulum-update');
    Route::get('kurikulum-delete/{kurikulum}', [kurikulumController::class, 'destroy'])->name('kurikulum-delete');

    //Mata Kuliah
    Route::get("mk", [MataKuliahController::class, 'index'])->name('mk-index');
    Route::get('mk-create', [MataKuliahController::class, 'create'])->name('mk-create');
    Route::post('mk-store', [MataKuliahController::class, 'store'])->name('mk-store');
    Route::get('mk-edit/{mataKuliah}', [MataKuliahController::class, 'edit'])->name('mk-edit');
    Route::post('mk-edit/{mataKuliah}', [MataKuliahController::class, 'update'])->name('mk-update');
    Route::get('mk-delete/{mataKuliah}', [MataKuliahController::class, 'destroy'])->name('mk-delete');
    Route::get("addKurikulumUser/{pengguna}", [userController::class, 'addKurikulum'])->name('addKurikulumUser');
    Route::post('addKurikulumUser/{pengguna}', [userController::class, 'storeKurikulum'])->name('storeKurikulum');

    Route::get("pole", [pollingController::class, 'index'])->name('pole-index');
    Route::get("pole-create", [pollingController::class, 'create'])->name('pole-create');
    Route::post("pole-store", [pollingController::class, 'store'])->name('pole-store');
    Route::get('pole-edit/{polling}', [pollingController::class, 'edit'])->name('pole-edit');
    Route::post('pole-edit/{polling}', [pollingController::class, 'update'])->name('pole-update');
    Route::get('pole-delete/{polling}', [pollingController::class, 'destroy'])->name('pole-delete');
});

Route::middleware(['auth','userAkses:User'])->group(function () {

});
//polling
Route::get("poleDetail", [pollingDetailController::class, 'index'])->name('poleDetail-index');
Route::get("poleDetail-create", [pollingDetailController::class, 'create'])->name('poleDetail-create');
Route::post("poleDetail-store", [pollingDetailController::class, 'store'])->name('poleDetail-store');
Route::get('poleDetail-edit/{pollingDetail}', [pollingDetailController::class, 'edit'])->name('poleDetail-edit');
Route::post('poleDetail-edit/{pollingDetail}', [pollingDetailController::class, 'update'])->name('poleDetail-update');
Route::get('poleDetail-delete/{pollingDetail}', [pollingDetailController::class, 'destroy'])->name('poleDetail-delete');

require __DIR__.'/auth.php';