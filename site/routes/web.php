<?php

use App\Http\Controllers\ProfileController;
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
});

require __DIR__.'/auth.php';


Route::get('/',[\App\Http\Controllers\HomeController::class,"index"])->name("home.index");
//Route::get("category/index",[\App\Http\Controllers\CategoryController::class,"index"])->name("category.index");
Route::resource('/category', \App\Http\Controllers\CategoryController::class);
Route::resource('/incomeSource', \App\Http\Controllers\IncomeSourceController::class);
Route::resource('/account', \App\Http\Controllers\AccountController::class);
