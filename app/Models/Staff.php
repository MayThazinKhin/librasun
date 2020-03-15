<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = ['name','nrc'];


    public function shifts()
    {
        return $this->belongsToMany(Shift::class);
    }
}
