<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemModifier extends Model
{
    protected $fillable = ['item_id','modifier_id'];
    protected $table = 'item_modifier';


    public function receipt_items()
    {
        return $this->belongsToMany(ReceiptItem::class,'receipt_item_modifier');
    }
}
