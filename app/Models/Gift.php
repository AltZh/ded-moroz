<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Letter;

class Gift extends Model {
    //protected $table = 'gifts_collection';

    public function letters(){
        return $this->belongsToMany(Letter::class);
    }
}