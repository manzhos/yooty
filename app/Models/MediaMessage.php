<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaMessage extends Model
{
    use HasFactory;

    protected $fillable = ['message_id', 'file_name'];

    public function message()
    {
        return $this->belongsTo(Message::class, 'message_id','id');
    }

}
