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
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\InvoiceController;
use App\Exports\MedicineTemplateExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\FrontendAuthController;
use App\Http\Controllers\FrontendAccountController;
use App\Http\Controllers\AccountController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/product/{medicine}', [ShopController::class, 'show'])->name('product.show');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{medicine}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.place');
Route::get('/invoice/{order}', [InvoiceController::class, 'download'])->name('invoice.download');


// Custom Frontend Login/Register Routes
Route::get('/frontend-login', [FrontendAuthController::class, 'showLogin'])->name('frontend-login');
Route::post('/frontend-login', [FrontendAuthController::class, 'login'])->name('frontend.login.submit');
Route::get('/frontend-register', [FrontendAuthController::class, 'showRegister'])->name('frontend.register');
Route::post('/frontend-register', [FrontendAuthController::class, 'register'])->name('frontend.register.submit');
Route::post('/frontend-logout', [FrontendAuthController::class, 'logout'])->name('frontend.logout');
Route::get('/my-account', [FrontendAccountController::class, 'index'])->name('frontend.my-account')->middleware('frontend.auth');

Route::middleware(['frontend.auth'])->post('/my-account/address', [AccountController::class, 'updateAddress'])->name('account.address');
Route::middleware(['frontend.auth'])->post('/my-account/password-reset', [AccountController::class, 'sendResetLink'])->name('account.reset');

// Checkout page (requires login)
Route::get('/checkout', [CheckoutController::class, 'index'])->middleware('frontend.auth')->name('checkout');




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

        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

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


        Route::get('/medicines/template/download', function () {
            return Excel::download(new MedicineTemplateExport, 'medicine-upload-template.xlsx');
        })->name('medicines.template.download');
    });
