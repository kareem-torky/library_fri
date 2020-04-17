<?php

use Illuminate\Support\Facades\Route;



/* Authors */

Route::get('/authors', 'ApiAuthorController@index');

Route::get('/authors/show/{id}', 'ApiAuthorController@show');

Route::post('/authors/store', 'ApiAuthorController@store');

Route::post('/authors/update/{id}', 'ApiAuthorController@update');

Route::get('/authors/delete/{id}', 'ApiAuthorController@delete');