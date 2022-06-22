<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;

class Produto extends Model
{
    protected $fillable = [
        'cliente_id',
        'name',
        'size',
        'price',
        'description',

    ];

    public function rules()
    {
        return [
            'cliente_id' => 'required',
            'name' => ' required',
            'size' => 'required',
            'price' => 'required',
            'description' => 'required',

        ];
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }
}
