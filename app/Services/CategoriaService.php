<?php

namespace App\Services;

use App\Models\Categoria;
use Exception;

class CategoriaService
{
    public static function store($request)
    {
        try {
            $categoria = Categoria::create($request);
            return [
                'status' => true,
                'categoria' => $categoria
            ];
        } catch(Exception $err) {
            return [
                'status' => false,
                'erro' => $err->getMessage()
            ];
        }
    }

    public static function getCategoriaPorId($id)
    {
        try {
            $categoria = Categoria::findOrFail($id);
            return [
                'status' => true,
                'categoria' => $categoria
            ];
        } catch(Exception $err) {
            return [
                'status' => false,
                'erro' => $err->getMessage()
            ];
        }
    }

    public static function update($request, $id)
    {
        try {
            $categoria = Categoria::findOrFail($id);
            $categoria->update($request);

            return [
                'status' => true,
                'categoria' => $categoria
            ];
        } catch(Exception $err) {
            return [
                'status' => false,
                'erro' => $err->getMessage()
            ];
        }
    }

    public static function destroy($id)
    {
        try {
            $user = Categoria::findOrFail($id);
            $user->delete();
            return [
                'status' => true
            ];
        } catch(Exception $err) {
            return [
                'status' => false,
                'erro' => $err->getMessage()
            ];
        }
    }

    public static function categorias()
    {
        return Categoria::all();
    }

    public static function listarCategorias($request)
    {
        $termoPesquisa = trim($request->searchTerm);

        if (empty($termoPesquisa)) {
            return Categoria::select('id', 'nome as text')->get();
        }

        return Categoria::select('id', 'nome as text')
                        ->where('nome', 'like', '%' . $termoPesquisa . '%')
                        ->get();
    }
}
