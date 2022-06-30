<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoApiController extends MasterApiController
{
    protected $model;
    protected $upload;
    protected $path;


    public function __construct(Produto $produtos, Request $request)
    {
        $this->model = $produtos;
        $this->request = $request;
    }

    public function registerProduct(Request $request)
    {
        $product = new Produto;

        $product->cliente_id = $request->cliente_id;
        $product->name = $request->name;
        $product->size = $request->size;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();

        return response()->json('Cadastrado com sucesso!');
    }

    public function cliente($id)
    {
        if (!$data = $this->model->with('cliente')->find($id)) {
            return response()->json(['error' => 'Nada foi encontrado!', 404]);
        } else {
            return response()->json($data);
        }
    }

    public function delete($id)
    {
        $product = Produto::find($id);
        if ($product) {
            if ($product->delete()) {
                return 'Produto deletado';
            }
        } else {
            return "Produto não existe";
        }
    }
}
