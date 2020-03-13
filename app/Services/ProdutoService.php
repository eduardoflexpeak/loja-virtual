<?php

namespace App\Services;

use App\Models\Produto;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProdutoService
{
    public static function store($request)
    {
        try {
            DB::beginTransaction();

            $produto = Produto::create(Arr::except($request, ['categorias', 'imagem_temp']));

            $produto->update([
                'imagem' => self::uploadImagem($produto, $request['imagem_temp'])
            ]);

            $produto->categorias()->sync($request['categorias']);

            DB::commit();
            return [
                'status' => true,
                'produto' => $produto
            ];
        } catch(Exception $err) {
            DB::rollBack();
            return [
                'status' => false,
                'erro' => $err->getMessage()
            ];
        }
    }

    public static function getProdutoPorId($id)
    {
        try {
            $produto = Produto::findOrFail($id);
            return [
                'status' => true,
                'produto' => $produto
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
            DB::beginTransaction();
            $produto = Produto::findOrFail($id);
            $produto->update(Arr::except($request, ['categorias', 'imagem_temp']));

            if (isset($request['imagem_temp'])) {
                $produto->update([
                    'imagem' => self::uploadImagem($produto, $request['imagem_temp'])
                ]);
            }

            $produto->categorias()->sync($request['categorias']);

            DB::commit();
            return [
                'status' => true,
                'produto' => $produto
            ];
        } catch(Exception $err) {
            DB::rollBack();
            return [
                'status' => false,
                'erro' => $err->getMessage()
            ];
        }
    }

    public static function destroy($id)
    {
        try {
            $produto = Produto::findOrFail($id);
            $produto->categorias()->detach();
            $produto->delete();
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

    public static function uploadImagem($produto, $arquivo)
    {
        $imagem = $produto->id . time() . "." . $arquivo->getClientOriginalExtension();
        $arquivo->move(public_path() . '/imagens/', $imagem);

        return $imagem;
    }
}
