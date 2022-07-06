<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

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

    public function update(Request $request, $id)
    {
        $product = Produto::findOrFail($id);
        $product->update([
            'cliente_id' => $request->cliente_id,
            'name' => $request->name,
            'size' => $request->size,
            'price' => $request->price,
            'description' => $request->description,
        ]);
        //return view('produto.update', ['produto' => $product]);
        return "Produto Atualizado com Sucesso!";
    }
}
