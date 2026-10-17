<?php

use Illuminate\Support\Facades\Route;

// ─── Public Controllers ────────────────────────────────────────────────────────
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\AboutController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\ProductController;

// ─── Admin Controllers ─────────────────────────────────────────────────────────
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Public\WaTrackingController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

// ─── Super Admin Controllers ───────────────────────────────────────────────────
use App\Http\Controllers\Admin\Super\UserController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\Super\DashboardController as SuperDashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\PortfolioController as AdminPortfolioController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\BrandCollabController as AdminBrandCollabController;

/*
|─────────────────────────────────────────────────────────────────────────────────
|   PUBLIC ROUTES - Company Profile
|─────────────────────────────────────────────────────────────────────────────────
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('produk')->controller(ProductController::class)->group(function () {
    Route::get('/',       'index')->name('product.index');
    Route::get('/{slug}', 'show')->name('product.show');
});

Route::get('/tentang-kami', [AboutController::class,     'index'])->name('about.index');

Route::prefix('kontak-kami')->controller(ContactController::class)->group(function () {
    Route::get('/',  'index')->name('contact.index');
    Route::post('/', 'store')->name('contact.store');
});

Route::post('/wa-track', [WaTrackingController::class, 'store'])->name('wa.track');

/*
|─────────────────────────────────────────────────────────────────────────────────
|   ADMIN AUTH ROUTES
|─────────────────────────────────────────────────────────────────────────────────
*/
Route::prefix('admin')->name('admin.')->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('/login',  [LoginController::class, 'showLogin'])->name('login');
        Route::post('/login', [LoginController::class, 'login']);
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    /*
    |─────────────────────────────────────────────────────────────────────────────
    |   SUPER ADMIN ROUTES
    |─────────────────────────────────────────────────────────────────────────────
    */
    Route::prefix('super')->name('super.')->middleware(['auth', 'active.user', 'role:super_admin'])->group(function () {
        Route::get('/dashboard', [SuperDashboardController::class, 'index'])->name('dashboard');
        
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/',                       [UserController::class, 'index'])->name('index');
            Route::post('/',                      [UserController::class, 'store'])->name('store');
            Route::put('/{user}',                 [UserController::class, 'update'])->name('update');
            Route::delete('/{user}',              [UserController::class, 'destroy'])->name('destroy');
            Route::post('/{user}/reset-password', [UserController::class, 'resetPassword'])->name('reset-password');
        });
    });

    /*
    |─────────────────────────────────────────────────────────────────────────────
    |   ADMIN KAOSINTIM ROUTES
    |─────────────────────────────────────────────────────────────────────────────
    */
    Route::middleware(['auth', 'active.user', 'role:admin'])->group(function () {
        Route::get('/dashboard',            [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/chart-data', [AdminDashboardController::class, 'chartData'])->name('dashboard.chart-data');

        Route::prefix('products')->name('products.')->group(function () {
            Route::get('/',             [AdminProductController::class, 'index'])->name('index');
            Route::post('/',            [AdminProductController::class, 'store'])->name('store');
            Route::get('/{product}',    [AdminProductController::class, 'edit'])->name('edit');
            Route::post('/{product}',   [AdminProductController::class, 'update'])->name('update');
            Route::delete('/{product}', [AdminProductController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('portfolios')->name('portfolios.')->group(function () {
            Route::get('/',           [AdminPortfolioController::class, 'index'])->name('index');
            Route::post('/',          [AdminPortfolioController::class, 'store'])->name('store');
            Route::get('/{portfolio}', [AdminPortfolioController::class, 'edit'])->name('edit');
            Route::post('/{portfolio}', [AdminPortfolioController::class, 'update'])->name('update');
            Route::delete('/{portfolio}', [AdminPortfolioController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('testimonials')->name('testimonials.')->group(function () {
            Route::get('/',               [AdminTestimonialController::class, 'index'])->name('index');
            Route::post('/',              [AdminTestimonialController::class, 'store'])->name('store');
            Route::get('/{testimonial}',  [AdminTestimonialController::class, 'edit'])->name('edit');
            Route::post('/{testimonial}', [AdminTestimonialController::class, 'update'])->name('update');
            Route::delete('/{testimonial}', [AdminTestimonialController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('faqs')->name('faqs.')->group(function () {
            Route::get('/',       [AdminFaqController::class, 'index'])->name('index');
            Route::post('/',      [AdminFaqController::class, 'store'])->name('store');
            Route::get('/{faq}',  [AdminFaqController::class, 'edit'])->name('edit');
            Route::post('/{faq}', [AdminFaqController::class, 'update'])->name('update');
            Route::delete('/{faq}', [AdminFaqController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('brands')->name('brands.')->group(function () {
            Route::get('/',        [AdminBrandCollabController::class, 'index'])->name('index');
            Route::post('/',       [AdminBrandCollabController::class, 'store'])->name('store');
            Route::get('/{brand}', [AdminBrandCollabController::class, 'edit'])->name('edit');
            Route::post('/{brand}', [AdminBrandCollabController::class, 'update'])->name('update');
            Route::delete('/{brand}', [AdminBrandCollabController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/',  [ProfileController::class, 'edit'])->name('edit');
            Route::post('/', [ProfileController::class, 'update'])->name('update');
        });
    });
});
