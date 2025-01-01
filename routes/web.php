<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Site\BookController;
use App\Http\Controllers\Site\BorrowBookController;
use App\Http\Controllers\Site\HomeController;

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

Route::as('site.')->group(function () {
    Route::middleware('auth')->group(function () {

        Route::controller(BorrowBookController::class)->group(function(){
            Route::get('books/borrowed', 'borrowedBooks')->name('books.borrowed');
            Route::get('books/borrowed/index', 'index')->name('books.index');
        });

        Route::controller(BookController::class)->group(function(){
            Route::get('books/{book_id}/borrowing', 'borrowing')->name('books.borrowing');
            Route::delete('books/{book_id}/destroy', 'destroy')->name('books.destroy');
            Route::get('books/{book_id}/edit', 'edit')->name('books.edit');
            Route::put('/books/{book_id}',  'update')->name('books.update');
            Route::get('/books/create',  'create')->name('books.create');
            Route::post('/books/store',  'store')->name('books.store');

        });
    });


    Route::get('/', HomeController::class)->name('home');
    Route::get('/books-data', [BookController::class, 'getBooksData'])->name('books.data');
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
