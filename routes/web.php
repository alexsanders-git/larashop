<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SizeController;
use Illuminate\Support\Facades\Route;

Route::get( '/', [ AdminController::class, 'login' ] )->name( 'admin.login' );
Route::post( 'admin/auth', [ AdminController::class, 'auth' ] )->name( 'admin.auth' );

Route::prefix( 'admin' )->middleware( 'admin' )->group( function () {
    Route::get( 'dashboard', [ AdminController::class, 'index' ] )->name( 'admin.index' );
    Route::post( 'logout', [ AdminController::class, 'logout' ] )->name( 'admin.logout' );

    /** Categories routes */
    Route::resource( 'categories', CategoryController::class, [
        'names' => [
            'index' => 'admin.categories.index',
            'create' => 'admin.categories.create',
            'store' => 'admin.categories.store',
            'show' => 'admin.categories.show',
            'edit' => 'admin.categories.edit',
            'update' => 'admin.categories.update',
            'destroy' => 'admin.categories.destroy',
        ]
    ] );

    /** Brands routes */
    Route::resource( 'brands', BrandController::class, [
        'names' => [
            'index' => 'admin.brands.index',
            'create' => 'admin.brands.create',
            'store' => 'admin.brands.store',
            'show' => 'admin.brands.show',
            'edit' => 'admin.brands.edit',
            'update' => 'admin.brands.update',
            'destroy' => 'admin.brands.destroy',
        ]
    ] );

    /** Colors routes */
    Route::resource( 'colors', ColorController::class, [
        'names' => [
            'index' => 'admin.colors.index',
            'create' => 'admin.colors.create',
            'store' => 'admin.colors.store',
            'show' => 'admin.colors.show',
            'edit' => 'admin.colors.edit',
            'update' => 'admin.colors.update',
            'destroy' => 'admin.colors.destroy',
        ]
    ] );

    /** Sizes routes */
    Route::resource( 'sizes', SizeController::class, [
        'names' => [
            'index' => 'admin.sizes.index',
            'create' => 'admin.sizes.create',
            'store' => 'admin.sizes.store',
            'show' => 'admin.sizes.show',
            'edit' => 'admin.sizes.edit',
            'update' => 'admin.sizes.update',
            'destroy' => 'admin.sizes.destroy',
        ]
    ] );

    /** Products routes */
    Route::resource( 'products', ProductController::class, [
        'names' => [
            'index' => 'admin.products.index',
            'create' => 'admin.products.create',
            'store' => 'admin.products.store',
            'show' => 'admin.products.show',
            'edit' => 'admin.products.edit',
            'update' => 'admin.products.update',
            'destroy' => 'admin.products.destroy',
        ]
    ] );

    /** Coupons routes */
    Route::resource( 'coupons', CouponController::class, [
        'names' => [
            'index' => 'admin.coupons.index',
            'create' => 'admin.coupons.create',
            'store' => 'admin.coupons.store',
            'show' => 'admin.coupons.show',
            'edit' => 'admin.coupons.edit',
            'update' => 'admin.coupons.update',
            'destroy' => 'admin.coupons.destroy',
        ]
    ] );

    /** Orders routes */
    Route::get( 'orders', [ OrderController::class, 'index' ] )->name( 'admin.orders.index' );
    Route::get( 'update/{order}/order', [ OrderController::class, 'updateDeliveredAtDate' ] )->name( 'admin.orders.update' );
    Route::delete( 'delete/{order}/order', [ OrderController::class, 'destroy' ] )->name( 'admin.orders.destroy' );
} );
