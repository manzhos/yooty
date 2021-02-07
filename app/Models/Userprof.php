<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Userprof extends Model
{
    protected $guarded=[];

    public function userprof()
    {
        return $this->belongsTo(User::class,'user_id','id', 'user_id');
    }

    public function science()
    {
        return $this->belongsTo(Science::class,'science_id','id', 'science_id');
    }

    public function education()
    {
        return $this->belongsTo(Education::class,'education_id','id', 'education_id');
    }

}
