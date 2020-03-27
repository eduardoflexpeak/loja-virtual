<?php

namespace App\Http\Controllers\Publico;

use App\Http\Controllers\Controller;
use App\Services\CarrinhoService;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function index()
    {
        return view('publico.carrinho.index');
    }

    public function store(Request $request)
    {
        $retorno = CarrinhoService::store($request->except(['_token']));

        if ($retorno['status']) {
            return back()->withSucesso($retorno['msg']);
        }

        return back()->withFalha($retorno['msg']);
    }

    public function update(Request $request, $id)
    {
        $retorno = CarrinhoService::update($request->all(), $id);

        if ($retorno['status']) {
            return back()->withSucesso($retorno['msg']);
        }

        return back()->withFalha($retorno['msg']);
    }

    public function destroy($id)
    {
        $retorno = CarrinhoService::destroy($id);

        if ($retorno['status']) {
            return back()->withSucesso($retorno['msg']);
        }

        return back()->withFalha($retorno['msg']);
    }
}
