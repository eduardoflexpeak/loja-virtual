<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register' => false
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::resource('user', 'UserController');
    Route::resource('categoria', 'CategoriaController');
    Route::resource('produto', 'ProdutoController');
    Route::get('lista-categorias', 'CategoriaController@listarCategorias')->name('lista.categorias');
});
