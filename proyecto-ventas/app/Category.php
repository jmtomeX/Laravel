<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'titulo',
    ];

    //Función de relación
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
