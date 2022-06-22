<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\Produto;

class ClienteApiController extends MasterApiController
{
    protected $model;
    protected $path = 'clientes';
    protected $upload = 'image';

    public function __construct(Cliente $clientes, Request $request)
    {
        $this->model = $clientes;
        $this->request = $request;
    }
    public function documento($id)
    {
        if (!$data = $this->model->with('documento')->find($id)) {
            return response()->json(['error' => 'Nada foi encontrado!', 404]);
        } else {
            return response()->json($data);
        }
    }
    public function produto($id)
    {
        if (!$data = $this->model->with('produto')->find($id)) {
            return response()->json(['error' => 'Nada foi encontrado!', 404]);
        } else {
            return response()->json($data);
        }
    }
}
