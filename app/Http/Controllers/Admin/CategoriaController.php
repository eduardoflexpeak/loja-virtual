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

    public function show(Categoria $categoria)
    {
        //
    }

    public function edit(Categoria $categoria)
    {
        //
    }

    public function update(Request $request, Categoria $categoria)
    {
        //
    }

    public function destroy(Categoria $categoria)
    {
        //
    }
}
