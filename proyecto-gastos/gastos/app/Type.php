<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    protected $fillable = [
        'description', 'user_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
