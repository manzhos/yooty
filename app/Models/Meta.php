<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Message;

class Meta extends Model
{
    protected $table = 'message_meta'; // non default name for table
    protected $guarded = [];

    public function message()
    {
        return $this->belongsTo(Message::class,'message_id','id');
    }
}
