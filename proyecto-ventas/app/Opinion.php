<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    protected $fillable = [
        'titulo', 'comentario', 'product_id', 'valor',
    ];

    //Funciones de relación:
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
