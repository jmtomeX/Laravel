<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenditure extends Model
{
    protected $fillable = [
        'date', 'description', 'amount', 'type_id', 'file',
    ];
    protected $guarded = [];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
