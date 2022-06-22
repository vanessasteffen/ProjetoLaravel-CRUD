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

    public function cliente($id){
        if (!$data = $this->model->with('cliente')->find($id)) {
            return response()->json(['error' => 'Nada foi encontrado!', 404]);
        } else {
            return response()->json($data);
        }
    }
}
