<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ManufacturerController;
use App\Http\Controllers\Admin\MedicineController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PincodeController;
use App\Http\Controllers\Admin\UnitController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ✅ Default Landing Page (Frontend Home)
Route::get('/', function () {
    return view('frontend.home');
})->name('home');

// ✅ Authentication Routes
Auth::routes();

// ✅ Profile for Logged-in Users
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// ✅ After Login, Redirect Based on Role
Route::get('/redirect-after-login', function () {
    if (auth()->check() && auth()->user()->is_admin) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('home');
})->name('redirect.after.login');

// ✅ Admin Panel Routes
Route::middleware(['auth', 'is_admin']) // make sure you have created is_admin middleware
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

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
