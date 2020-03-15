<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = ['start_time','end_time','staff_id'];

    public function staffs()
    {
        return $this->belongsToMany(Staff::class);
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }
}
