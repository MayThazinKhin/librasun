<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Set extends Model
{
    protected $fillable = ['name','price'];


    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function receipts()
    {
        return $this->belongsToMany(Receipt::class)->withPivot('quantity');
    }

    public function getItemName()
    {
        return $this->items()->pluck('name')->all();
    }

}
