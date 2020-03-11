<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProdutoDataTable;
use App\Http\Controllers\Controller;
use App\Services\ProdutoService;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index(ProdutoDataTable $produtoDataTable)
    {
        return $produtoDataTable->render('admin.produto.index');
    }

    public function create()
    {
        return view('admin.produto.form');
    }

    public function store(Request $request)
    {
        $retorno = ProdutoService::store($request->all());

        if ($retorno['status']) {
            return redirect()->route('admin.produto.index')
                    ->withSucesso('Produto salvo com sucesso');
        }

        return back()->withInput()
                ->withFalha('Ocorreu um erro ao salvar');
    }

    public function edit($id)
    {
        $retorno = ProdutoService::getProdutoPorId($id);

        if ($retorno['status']) {
            return view('admin.produto.form', [
                'produto' => $retorno['produto']
            ]);
        }

        return back()->withFalha('Ocorreu um erro ao selecionar o produto');
    }

    public function update(Request $request, $id)
    {
        $retorno = ProdutoService::update($request->all(), $id);

        if ($retorno['status']) {
            return redirect()->route('admin.produto.index')
                    ->withSucesso('Produto atualizado com sucesso');
        }

        return back()->withInput()
                ->withFalha('Ocorreu um erro ao atualizar');
    }

    public function destroy($id)
    {
        $retorno = ProdutoService::destroy($id);

        if ($retorno['status']) {
            return 'Produto excluído com sucesso';
        }

        abort(403, 'Erro ao excluir, ' . $retorno['erro']);
    }
}
