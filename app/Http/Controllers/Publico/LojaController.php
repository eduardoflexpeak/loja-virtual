<?php

namespace App\Http\Controllers\Publico;

use App\Http\Controllers\Controller;
use App\Services\CategoriaService;
use App\Services\ProdutoService;
use Illuminate\Http\Request;

class LojaController extends Controller
{
    public function index()
    {
        return view('publico.inicio', [
            'produtos' => ProdutoService::listaProdutos(),
            'categorias' => CategoriaService::categorias()
        ]);
    }
}
