<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    protected $guarded=[];

    public function userprof()
    {
        return $this->hasMany(Userprof::class,'education_id','id');
    }

    public function message()
    {
        return $this->belongsToMany(Message::class,'education_message','education_id', 'message_id');
    }

}
