<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/authors', ['uses'=>'AuthorController@index', 'as'=>'authors.index']);
Route::get('/authors/add', ['uses'=>'AuthorController@add', 'as'=>'authors.add']);
Route::post('/authors/save', ['uses'=>'AuthorController@save', 'as'=>'authors.save']);
Route::get('/authors/edit/{id}', ['uses'=>'AuthorController@edit', 'as'=>'authors.edit']);
Route::post('/authors/update/{id}', ['uses'=>'AuthorController@update', 'as'=>'authors.update']);
Route::get('/authors/delete/{id}', ['uses'=>'AuthorController@delete', 'as'=>'authors.delete']);
Route::put('/authors/search', ['uses'=>'AuthorController@search', 'as'=>'authors.search']);
Route::get('/books', ['uses'=>'BookController@index', 'as'=>'books.index']);
Route::get('/books/add', ['uses'=>'BookController@add', 'as'=>'books.add']);
Route::post('/books/save', ['uses'=>'BookController@save', 'as'=>'books.save']);
Route::get('/books/edit/{id}', ['uses'=>'BookController@edit', 'as'=>'books.edit']);
Route::post('/books/update/{id}', ['uses'=>'BookController@update', 'as'=>'books.update']);
Route::get('/books/delete/{id}', ['uses'=>'BookController@delete', 'as'=>'books.delete']);
Route::put('/books/search', ['uses'=>'BookController@search', 'as'=>'books.search']);

Route::get('/lendings', ['uses'=>'LendingController@index', 'as'=>'lendings.index']);
Route::get('/lendings/new', ['uses'=>'LendingController@emprestimo', 'as'=>'lendings.new']);
Route::post('/lendings/add', ['uses'=>'LendingController@add', 'as'=>'lendings.add']);
Route::get('/lendings/devolucao/{id}', ['uses'=>'LendingController@devolucao', 'as'=>'lendings.devolucao']);
