<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Gift;

class Letter extends Model
{
    public function gifts()
    {
        return $this->belongsToMany(Gift::class);
    }
}
