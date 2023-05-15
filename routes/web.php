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
use App\Http\Controllers\UserController;
use App\Models\Item;

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
    Route::resource('/user', UserController::class);
    Route::get('/items.csv', [ItemController::class, 'exportCSV'])->name('item.csv')->withoutMiddleware(['auth']);
    Route::get('/items/print', [ItemController::class, 'print'])->name('item.print')->withoutMiddleware(['auth']);
    Route::get('/items/pdf', [ItemController::class, 'pdf'])->name('item.pdf')->withoutMiddleware(['auth']);
    Route::get('/', [ItemController::class, 'guestPage'])->name('guest.page')->withoutMiddleware(['auth']);
    Route::get('/item/{id}', [ItemController::class, 'show'])->name('item.show')->withoutMiddleware(['auth']);
    Route::get('/get-item-details/{id}', 'InventoryController@getItemDetails');
    Route::get('/fetch-advices', [ItemController::class, 'fetchAdvices'])->name('fetchAdvices');
    Route::get('/items/generateAdviceForAllItems', [ItemController::class, 'generateAdviceForAllItems'])->name('item.generateAdviceForAllItems');
    Route::get('/items/messages', [ItemController::class, 'getMessages'])->name('item.getMessages');
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('users/create', [UserController::class, 'create'])->name('user.create');
        Route::get('users', [UserController::class, 'index'])->name('user.index');
    });
    
    





      
      


});

require __DIR__.'/auth.php';
