<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'producto', 'descripcion', 'precio', 'image', 'category_id',
    ];

    //Funciones de relación:
    public function opinions()
    {
        return $this->hasMany(Opinion::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
