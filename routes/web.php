<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;


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

Route::get('/', [HomeController::class, 'HomePage']);
Route::get('/post_details/{id}', [HomeController::class, 'postDetails']);


Route::get('/home', [AdminController::class, 'index'])->name('home');

Route::get('/post_page', [AdminController::class, 'postPage']);
Route::post('/add_post', [AdminController::class, 'addPost']);
Route::get('/show_post', [AdminController::class, 'showPost']);
Route::get('/delete_post/{id}', [AdminController::class, 'deletePost']);
Route::get('/edit_page/{id}', [AdminController::class, 'editPage']);
Route::post('/update_post/{id}', [AdminController::class, 'updatePage']);
