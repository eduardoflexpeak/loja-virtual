<?php

namespace App\Services;

use function Complex\sec;

class CarrinhoService
{
    public static function store($request)
    {
        $p = ProdutoService::getProdutoPorId($request['produto']);

        if (!$p['status']) {
            return [
                'status' => false,
                'msg' => 'Erro ao selecionar o produto'
            ];
        }

        $carrinho = session()->get('carrinho');

        // Se o carrinho estiver vazio, então vamos adicionar o primeiro produto
        if(!$carrinho) {

            $carrinho = [
                $p['produto']->id => [
                    "nome" => $p['produto']->nome,
                    "quantidade" => $request['quantidade'],
                    "preco" => $p['produto']->preco,
                    "imagem" => $p['produto']->imagem
                ]
            ];

            session()->put('carrinho', $carrinho);

            self::totalCarrinho();

            return [
                'status' => true,
                'msg' => $p['produto']->nome . ' adicionado ao carrinho'
            ];
        }

        // Se o carrinho não estiver vazio e o produto já se encontrar no mesmo, vamos incrementar a quantidade
        if(isset($carrinho[$p['produto']->id])) {

            $carrinho[$p['produto']->id]['quantidade']++;

            session()->put('carrinho', $carrinho);

            self::totalCarrinho();

            return [
                'status' => true,
                'msg' => $p['produto']->nome . ' adicionado ao carrinho'
            ];

        }

        // Se o carrinho não estiver vazio, vamos adicionar um novo produto e sua quantidade
        $carrinho[$p['produto']->id] = [
            "nome" => $p['produto']->nome,
            "quantidade" => $request['quantidade'],
            "preco" => $p['produto']->preco,
            "imagem" => $p['produto']->imagem
        ];

        session()->put('carrinho', $carrinho);

        self::totalCarrinho();

        return [
            'status' => true,
            'msg' => $p['produto']->nome . ' adicionado ao carrinho'
        ];
    }

    public static function update($request, $id)
    {
        $carrinho = session()->get('carrinho');

        if (isset($carrinho[$id])) {

            $carrinho[$id]["quantidade"] = $request['quantidade'];
            session()->put('carrinho', $carrinho);

            self::totalCarrinho();

            return [
                'status' => true,
                'msg' => 'Quantidade do produto foi atualizada'
            ];
        }

        return [
            'status' => false,
            'msg' => 'Produto informado não está no carrinho'
        ];
    }

    public static function destroy($id)
    {
        $carrinho = session()->get('carrinho');

        if (isset($carrinho[$id])) {

            unset($carrinho[$id]);
            session()->put('carrinho', $carrinho);

            self::totalCarrinho();

            return [
                'status' => true,
                'msg' => 'Produto removido do carrinho'
            ];
        }

        return [
            'status' => false,
            'msg' => 'Produto informado não está no carrinho'
        ];
    }

    public static function totalCarrinho()
    {
        $carrinho = session()->get('carrinho');
        $total = 0;

        foreach ($carrinho as $c) {
            $total += $c['preco'] * $c['quantidade'];
        }

        session()->put('total', $total);
    }
}
