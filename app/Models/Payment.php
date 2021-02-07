<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Message;

class Payment extends Model
{
    protected $guarded = [];

    public function message()
    {
        return $this->belongsTo(Message::class,'message_id','id');
    }
}
