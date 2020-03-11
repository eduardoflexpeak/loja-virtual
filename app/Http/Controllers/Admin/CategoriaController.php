<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoriaDataTable;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoriaRequest;
use App\Services\CategoriaService;

class CategoriaController extends Controller
{
    public function index(CategoriaDataTable $categoriaDataTable)
    {
        return $categoriaDataTable->render('admin.categoria.index');
    }

    public function create()
    {
        return view('admin.categoria.form');
    }

    public function store(CategoriaRequest $request)
    {
        $retorno = CategoriaService::store($request->all());

        if ($retorno['status']) {
            return redirect()->route('admin.categoria.index')
                    ->withSucesso('Categoria salva com sucesso');
        }

        return back()->withInput()
                ->withFalha('Ocorreu um erro ao salvar');
    }

    public function edit($id)
    {
        $retorno = CategoriaService::getCategoriaPorId($id);

        if ($retorno['status']) {
            return view('admin.categoria.form', [
                'categoria' => $retorno['categoria']
            ]);
        }

        return back()->withFalha('Ocorreu um erro ao selecionar a categoria');
    }

    public function update(Request $request, $id)
    {
        $retorno = CategoriaService::update($request->all(), $id);

        if ($retorno['status']) {
            return redirect()->route('admin.categoria.index')
                    ->withSucesso('Categoria atualizada com sucesso');
        }

        return back()->withInput()
                ->withFalha('Ocorreu um erro ao atualizar');
    }

    public function destroy($id)
    {
        $retorno = CategoriaService::destroy($id);

        if ($retorno['status']) {
            return 'Categoria excluída com sucesso';
        }

        abort(403, 'Erro ao excluir, ' . $retorno['erro']);
    }

    public function listarCategorias(Request $request)
    {
        return CategoriaService::listarCategorias($request);
    }
}
