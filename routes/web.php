<?php

Route::namespace('Auth')->group(function () {
    Route::get('cliente/login', 'LoginController@clienteLogin')->name('login.cliente');

    Route::get('cliente/registro', function () {
        return view('publico.auth.registro');
    })->name('registro.cliente');

    Route::get('admin/login', 'LoginController@adminLogin')->name('login.admin');

    Route::post('login', 'LoginController@login')->name('login.attempt');
    Route::post('registro', 'RegisterController@registroCliente')->name('registro.cliente.attemp');
    Route::post('logout', 'LoginController@logout')->name('logout');
});

Route::namespace('Publico')->name('publico.')->group(function () {
    Route::get('/', 'LojaController@index')->name('loja');
    Route::resource('carrinho', 'CarrinhoController');
    Route::get('categoria/{id}', 'CategoriaController@index')->name('categoria');

    Route::middleware('cliente')->group(function () {
        Route::resource('conta', 'ContaController');
    });
});

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth', 'admin'])->namespace('Admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('user', 'UserController');
    Route::resource('categoria', 'CategoriaController');
    Route::resource('produto', 'ProdutoController');
    Route::get('lista-categorias', 'CategoriaController@listarCategorias')->name('lista.categorias');
});
