<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Usermeta extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
