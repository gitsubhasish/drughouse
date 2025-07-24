<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ManufacturerController;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Admin\OrderController;

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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');




Route::middleware(['auth', 'is_admin']) // create is_admin middleware
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

    Route::resource('categories', CategoryController::class);
    Route::resource('manufacturers', ManufacturerController::class);
    Route::resource('medicines', MedicineController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('units', UnitController::class);
    Route::resource('pincodes', PincodeController::class);

    // Extra routes
    Route::post('medicines/import', [MedicineController::class, 'import'])
        ->name('medicines.import');

    Route::post('orders/{order}/status', [OrderController::class, 'updateStatus'])
        ->name('orders.updateStatus');

    Route::get('orders/{order}/invoice', [OrderController::class, 'invoice'])
        ->name('orders.invoice');
});

