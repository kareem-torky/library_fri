<?php

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

/* Auth */

// register
Route::get('/register', 'AuthController@register')->name('auth.register');
Route::post('/do-register', 'AuthController@doRegister')->name('auth.doRegister');

// login
Route::get('/login', 'AuthController@login')->name('auth.login');
Route::post('/do-login', 'AuthController@doLogin')->name('auth.doLogin');

Route::middleware('userAuth')->group(function() {

    // logout
    Route::get('/logout', 'AuthController@logout')->name('auth.logout');


    Route::middleware('isAdmin')->group(function(){
        // Delete
        Route::get('/authors/delete/{id}', 'AuthorController@delete')->name('authors.delete');
    
        // Delete
        Route::get('/books/delete/{id}', 'BookController@delete')->name('books.delete');
    });

    
    // Create 
    Route::get('/authors/create', 'AuthorController@create')->name('authors.create');
    Route::post('/authors/store', 'AuthorController@store')->name('authors.store');

    // Update
    Route::get('/authors/edit/{id}', 'AuthorController@edit')->name('authors.edit');    
    Route::post('/authors/update/{id}', 'AuthorController@update')->name('authors.update');

    // Create 
    Route::get('/books/create', 'BookController@create')->name('books.create');
    Route::post('/books/store', 'BookController@store')->name('books.store');

    // Update
    Route::get('/books/edit/{id}', 'BookController@edit')->name('books.edit');
    Route::post('/books/update/{id}', 'BookController@update')->name('books.update');
});


Route::get('/', function () {
    return view('welcome');
});

/* Authors */

// Read
Route::get('/authors', 'AuthorController@index')->name('authors.index');
Route::get('/authors/latest', 'AuthorController@latest')->name('authors.latest');
Route::get('/authors/show/{id}', 'AuthorController@show')->name('authors.show');
Route::get('/authors/search/{word}', 'AuthorController@search')->name('authors.search');






/* Books */

// Read
Route::get('/books', 'BookController@index')->name('books.index');
// Route::get('/books/latest', 'BookController@latest')->name('books.latest');
Route::get('/books/show/{id}', 'BookController@show')->name('books.show');
// Route::get('/books/search/{word}', 'BookController@search')->name('books.search');


// /message/send MessageController @ send
Route::post('/message/send', 'MessageController@send')->name('message.send');