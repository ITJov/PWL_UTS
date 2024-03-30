    <?php

use App\Http\Controllers\kurikulumController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\roleController;
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
// MataKuliah
Route::get("mk", [MataKuliahController::class, 'index'])->name('mk-index');
Route::get('mk-create', [MataKuliahController::class, 'create'])->name('mk-create');
Route::post('mk-store', [MataKuliahController::class, 'store'])->name('mk-store');
Route::get('mk-edit/{mataKuliah}', [MataKuliahController::class, 'edit'])->name('mk-edit');
Route::post('mk-edit/{mataKuliah}', [MataKuliahController::class, 'update'])->name('mk-update');
Route::get('mk-delete/{mataKuliah}', [MataKuliahController::class, 'destroy'])->name('mk-delete');


// Role
Route::get("role", [roleController::class, 'index'])->name('role-index');
Route::get("role-create", [roleController::class, 'create'])->name('role-create');
Route::post("role-store", [roleController::class, 'store'])->name('role-store');
Route::get('role-edit/{role}', [roleController::class,'edit'])->name('role-edit');
Route::post('role-edit/{role}', [roleController::class, 'update'])->name('role-update');
Route::get('role-delete/{role}', [roleController::class, 'destroy'])->name('role-delete');

// Kurikulum
Route::get("kurikulum", [kurikulumController::class, 'index'])->name('kurikulum-index');
Route::get("kurikulum-create", [kurikulumController::class, 'create'])->name('kurikulum-create');
Route::post("kurikulum-store", [kurikulumController::class, 'store'])->name('kurikulum-store');
Route::get('kurikulum-edit/{kurikulum}', [kurikulumController::class, 'edit'])->name('kurikulum-edit');
Route::post('kurikulum-edit/{kurikulum}', [kurikulumController::class, 'update'])->name('kurikulum-update');
Route::get('kurikulum-delete/{kurikulum}', [kurikulumController::class, 'destroy'])->name('kurikulum-delete');

Route::get("user", [userController::class, 'index'])->name('user-index');

Route::get('/', function () {
    return view('home');
});
