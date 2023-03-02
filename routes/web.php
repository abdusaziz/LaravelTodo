<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\MyauthController;

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
})->name('home');


Route::middleware(['guest'])->group(function () {
    Route::get('login',[AuthController::class,'index'])->name('login');
    Route::post('login',[AuthController::class,'login'])->name('login');

    Route::get('register',[AuthController::class,'registerView'])->name('register');
    Route::post('register',[AuthController::class,'register'])->name('register');

});

Route::middleware(['auth'])->group(function () {
    Route::get('logout',[AuthController::class,'logout'])->name('logout');
    Route::resource('todo',TodoController::class);
    Route::resource('task',TaskController::class);

});


// Route::middleware(['guest'])->prefix('new')->group(function(){
//     Route::get('login',[MyauthController::class,'loginView'])->name('login');
//     Route::post('login',[MyauthController::class,'login'])->name('login');

//     Route::get('register',[MyauthController::class,'registerView'])->name('register');
//     Route::post('register',[MyauthController::class,'register'])->name('register');
// });

// Route::middleware(['auth'])->prefix('new')->group(function(){
//     Route::get('logout',[MyauthController::class,'logout'])->name('new.logout');

//     Route::get('todo',[TodoController::class,'index'])->name('new.todo');
// });


