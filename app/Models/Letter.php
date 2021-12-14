<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Gift;
use App\Models\User;

class Letter extends Model
{
    public function gifts()
    {
        return $this->belongsToMany(Gift::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
}
