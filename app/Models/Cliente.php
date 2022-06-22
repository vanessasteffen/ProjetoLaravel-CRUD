<?php

namespace App\Models;

use App\Models\Documento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;

class Cliente extends Model
{
    protected $fillable = [
        'name',
        'image',
        //'cpf_cnpj',
    ];

    public function rules(){
        return [
            'name' => 'required',
            'image' => 'image',
            //'cpf_cnpj' => 'required|unique:clientes'
        ];
    }

    public function documento()
    {
        return $this->hasOne(Documento::class, 'cliente_id', 'id');
    }
    public function produto()
    {//hasMany tem muitos significa
        return $this->hasMany(Produto::class, 'cliente_id', 'id');
    }
}
