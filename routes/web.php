<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\CategoryController as ControllersCategoryController;
use App\Http\Controllers\TagController as ControllersTagController;
use App\Http\Controllers\UserController;
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

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', [MainController::class, 'index'])->name('admin.index');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/tags', TagController::class);
    Route::resource('/posts', AdminPostController::class);
});


Route::group(['middleware' => 'guest'], function(){
    Route::get('/register', [UserController::class, 'create'])->name('register.create');
    Route::post('/register', [UserController::class, 'store'])->name('register.store');
});
    

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [UserController::class, 'loginForm'])->name('login.create');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');



Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/article/{slug}', [PostController::class, 'show'])->name('posts.single');
Route::get('/category/{slug}', [ControllersCategoryController::class, 'show'])->name('categories.single');
Route::get('/tag/{slug}', [ControllersTagController::class, 'show'])->name('tags.single');


