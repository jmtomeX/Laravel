<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'user_id', 'category',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function types()
    {
        return $this->hasMany(Type::class);
    }
}
