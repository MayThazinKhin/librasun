<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name','price'];

    public function modifiers()
    {
        return $this->belongsToMany(Modifier::class);
    }

    public function receipt()
    {
        return $this->belongsToMany(Receipt::class);
    }

    public function sets()
    {
        return $this->belongsToMany(Set::class);
    }
}
