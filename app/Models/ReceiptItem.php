<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiptItem extends Model
{
    protected $fillable = ['item_id','receipt_id','quantity'];
    protected $table = 'receipt_item';

    public function item_modifiers()
    {
        return $this->belongsToMany(ItemModifier::class,'receipt_item_modifier');
    }

}
