<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InventoryTypeController;
use App\Http\Controllers\ItemCategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\UnitTypeController;
use App\Http\Controllers\PrefixController;
use App\Http\Controllers\ItemController;


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
    return redirect('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('/department', DepartmentController::class);
    Route::resource('/inventory_type', InventoryTypeController::class);
    Route::resource('/item_category', ItemCategoryController::class);
    Route::resource('/location', LocationController::class);
    Route::resource('/unit_type', UnitTypeController::class);
    Route::resource('/prefix', PrefixController::class);
    Route::resource('/item', ItemController::class);
    Route::resource('/inventory', InventoryController::class);
    Route::get('/qrcode/generate/{itemId}', [QrcodeController::class, 'generate']);

});

require __DIR__.'/auth.php';
