<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class MasterApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $data = $this->model->all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        //metodo para inserir dados nas tabelas
        $this->validate($request, $this->model->rules());
        $dataForm = $request->all();

        //verifica se existe o arquivo para upload
        if ($request->hasFile($this->upload) && $request->file($this->upload)->isValid()) {
            $extension = $request->file($this->image)->extension();
            $name = uniqid(date('His'));
            $nameFile = "{$name}.{$extension}";
            $upload = Image::make($dataForm[$this->upload])->resize(177, 236)->save(storage_path("app/public/clientes/$nameFile, 70"));

            //verifica se existe arquivo para upload
            if (!$upload) {
                return response()->json(['error' => 'Falha ao fazer upload'], 500);
            } else {
                $dataForm[$this->upload] = $nameFile;
            }
        }
        $data = $this->model->create($dataForm);
        return response()->json($data, 201);
    }

    public function show($id)
    {
        if (!$data = $this->model->find($id)) {
            return response()->json(['error' => 'Nada foi encontrado!', 404]);
        } else {
            return response()->json($data);
        }
    }


    public function update(Request $request, $id)
    { //atualizando os dados
        if (!$data = $this->model->find($id)) {
            return response()->json(['error' => 'Nada foi encontrado!', 404]);
        }
        //metodo para inserir dados nas tabelas
        $this->validate($request, $this->model->rules());
        $dataForm = $request->all();

        //verifica se existe o arquivo para upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $arquivo = $this->model->arquivo($id);
            if ($arquivo) {
                Storage::disk('public')->delete("/{$this->path}/$arquivo");
            }
            $extension = $request->image->extension();
            $name = uniqid(date('His'));
            $nameFile = "{$name}.{$extension}";
            $upload = Image::make($dataForm['image'])->resize(177, 236)->save(storage_path("app/public/{$this->path}/{$nameFile}, 70"));

            //verifica se existe arquivo para upload
            if (!$upload) {
                return response()->json(['error' => 'Falha ao fazer upload'], 500);
            } else {
                $dataForm['image'] = $nameFile;
            }
        }
        $data->update($dataForm);
        return response()->json($data);
    }


    public function destroy($id)
    { //deletando os dados pelo id
        if (!$data = $this->model->find($id)) {
            //verifica se existe imagem para deletar
            if (method_exists($this->model, 'arquivo')) {
                Storage::disk('public')->delete("/{$this->path}/{$this->model->arquivo($id)}");
            }
            $data->delete();
            return response()->json(['sucess' => 'Deletado com sucesso!']);
        } else {
            return response()->json(['error' => 'Nada foi encontrado!', 404]);
        }
    }
}
