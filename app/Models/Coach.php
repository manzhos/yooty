<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Coach extends Model
{
    protected $guarded=[];

    public function user()
    {
        return $this->belongToMany(User::class);
    }
}
