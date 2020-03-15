<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class receipt extends Model
{
    protected $fillable = ['payment_type','sub_total','grand_total','discount','shift_id'];


    public function items()
    {
        return $this->belongsToMany(Item::class);
    }

    public function sets()
    {
        return $this->belongsToMany(Set::class)->withPivot('quantity');
    }

    public function receipt_items()
    {
        return $this->belongsToMany(ReceiptItem::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }



}
