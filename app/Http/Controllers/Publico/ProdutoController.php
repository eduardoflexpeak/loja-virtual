<?php

namespace App\Http\Controllers\Publico;

use App\Http\Controllers\Controller;
use App\Services\ProdutoService;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function detalhes($id)
    {
        $retorno = ProdutoService::getProdutoPorId($id);

        if ($retorno['status']) {
            return view('publico.produto.detalhes', [
                'produto' => $retorno['produto']
            ]);
        }

        return back()->withErrors('Erro ao selecionar o produto');
    }
}
