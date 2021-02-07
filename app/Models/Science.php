<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Science extends Model
{
    protected $guarded=[];

    public function message()
    {
        return $this->belongsToMany(Message::class, 'message_science', 'science_id', 'message_id');
    }

    public function userprof()
    {
        return $this->hasMany(Userprof::class,'science_id','id');
    }
}
