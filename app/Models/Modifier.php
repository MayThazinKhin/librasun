<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modifier extends Model
{
    protected $fillable = ['name','price'];

    public function items()
    {
        return $this->belongsToMany(Item::class);
    }
}
