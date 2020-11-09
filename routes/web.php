<?php

use App\Http\Controllers\UsersController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\BookshelfsController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PhonesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// PagesController mencakup Form Login dan register, Proses Register, Login Dan Logout
Route::get('/', [PagesController::class, 'index']);
Route::get('/register', [PagesController::class, 'register']);
Route::post('/do_register', [PagesController::class, 'do_register']);
Route::post('/do_login', [PagesController::class, 'do_login']);
Route::get('/do_logout', [PagesController::class, 'do_logout']);

// Penanganan Menu User (CRUD)
Route::get('/users', [UsersController::class, 'index']);
Route::get('/users/create', [UsersController::class, 'create']);
Route::post('/users/store', [UsersController::class, 'store']);
Route::get('/users/show/{id}', [UsersController::class, 'show']);
Route::get('/users/edit/{id}', [UsersController::class, 'edit']);
Route::patch('/users/update', [UsersController::class, 'update']);
Route::delete('/users/destroy', [UsersController::class, 'destroy']);
Route::get('/user/detail', [UsersController::class, 'detail'])->name('detail.user');

// Penanganan Access Level
Route::get('/access', [AccessController::class, 'index'])->name('access');
Route::get('/access/edit/{access_id}', [AccessController::class, 'edit']);
Route::patch('/access/update', [AccessController::class, 'update']);

// Penanganan Nomor Telepon
Route::post('/phone/store', [PhonesController::class, 'store'])->name('post_number');
Route::delete('/phone/destroy', [PhonesController::class, 'destroy']);

// Penanganan Rak Buku (Bookshelfs)
Route::get('/bookshelfs', [BookshelfsController::class, 'index']);
Route::get('/bookshelfs/create', [BookshelfsController::class, 'create']);
Route::post('/bookshelfs/store', [BookshelfsController::class, 'store']);


// Penanganan Kategori Buku (Categories)
Route::get('/categories', [CategoriesController::class, 'index']);
Route::get('/categories/create', [CategoriesController::class, 'create']);
Route::get('/categories/edit/{id}', [CategoriesController::class, 'edit']);
Route::post('/categories/store', [CategoriesController::class, 'store']);
Route::patch('/categories/update', [CategoriesController::class, 'update']);


// Penanganan Penerbit Buku (Publisers)
Route::get('/publishers', [PublishersController::class, 'index']);
Route::get('/publishers/create', [PublishersController::class, 'create']);
Route::post('/publishers/store', [PublishersController::class, 'store']);


// Penanganan Buku (Books)
Route::get('/books', [BooksController::class, 'index']);
Route::get('/books/create', [BooksController::class, 'create']);
Route::post('/books/store', [BooksController::class, 'store']);
