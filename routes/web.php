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
Route::get('/accept_post/{id}', [AdminController::class, 'acceptPost']);
Route::get('/reject_post/{id}', [AdminController::class, 'rejectPost']);


Route::get('/create_post', [HomeController::class, 'createPost'])->middleware('auth');
Route::post('/user_post', [HomeController::class, 'userPost'])->middleware('auth');
Route::get('/my_post', [HomeController::class, 'myPost'])->middleware('auth');
Route::get('/my_post_del/{id}', [HomeController::class, 'userDelPost'])->middleware('auth');
Route::get('/post_update_page/{id}', [HomeController::class, 'userPostUpdate'])->middleware('auth');
Route::post('/update_post_data/{id}', [HomeController::class, 'updatePostData'])->middleware('auth');


