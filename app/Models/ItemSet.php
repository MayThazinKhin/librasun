<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ItemSet extends Model
{
    protected $fillable = ['item_id','modifier_id'];
    protected $table = 'item_set';
}
