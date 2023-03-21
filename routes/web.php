<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\front\CartController;
use App\Http\Controllers\front\CheckoutController;
use App\Http\Controllers\front\homeController;
use App\Http\Controllers\front\ProductsFrontController;
use App\Http\Controllers\front\StoreController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\Profile;
use App\Http\Middleware\CheckUserType;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardControlle;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrderController;

Route::get('/',[homeController::class,"index"])->name("home");

// Route::get('/dashboard',[DashboardControlle::class,"index"])
//     ->middleware(['auth', 'verified',CheckUserType::class])
//     ->name('dashboard');
Route::get('/dashboard',[DashboardControlle::class,"index"])
    ->middleware(['auth', CheckUserType::class])
    ->name('dashboard');

    
Route::get('dashboard/profile',[Profile::class,'edit'])->name("profile.edit");
Route::patch('dashboard/profile',[Profile::class,'update'])->name("profile.update");

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::get("dashboard/categories/trash",[CategoriesController::class,"trash"])->name("categories.trash")->middleware(["auth",CheckUserType::class]);
Route::put("dashboard/categories/{categorie}/restore",[CategoriesController::class,"restore"])->name("categories.restore")->middleware(["auth",CheckUserType::class]);
Route::delete("dashboard/categories/{categorie}/forceDelete",[CategoriesController::class,"forceDelete"])->name("categories.forceDetele")->middleware(["auth",CheckUserType::class]);

Route::resource("dashboard/categories",CategoriesController::class)->middleware(["auth",CheckUserType::class]);
Route::resource("dashboard/products",ProductsController::class)->middleware(["auth",CheckUserType::class]);

Route::get("/products",[ProductsFrontController::class,"index"])->name("products.index");
Route::get("/products/{product:slug}",[ProductsFrontController::class,"show"])->name("products.show");

Route::resource("cart",CartController::class);
Route::resource("store",StoreController::class)->middleware("auth");

Route::get("checkout", [CheckoutController::class,"create"])->name("checkout");
Route::post("checkout", [CheckoutController::class,"store"])->name("checkout");
Route::resource("dashboard/orders",OrderController::class);

Route::resource("admin/dashboard",AdminController::class)->middleware(["auth:admin"]);
Route::get("admin/categories",[AdminController::class,"categories"])->middleware(["auth:admin"]);
Route::get("admin/products",[AdminController::class,"product"])->middleware(["auth:admin"]);
Route::get("admin/orders",[AdminController::class,"order"])->middleware(["auth:admin"]);
Route::get("admin/users",[AdminController::class,"user"])->middleware(["auth:admin"]);

// require __DIR__.'/auth.php';