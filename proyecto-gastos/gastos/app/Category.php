<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'user_id', 'description',
    ];

    public function types()
    {
        return $this->hasMany(Type::class);
    }
}
