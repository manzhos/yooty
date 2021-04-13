<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Collection;

class Message extends Model
{

    protected $fillable=['subject', 'message'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'message_id','id');
    }

    public function media()
    {
        return $this->hasMany(MediaMessage::class, 'message_id','id');
    }

    public function sciences()
    {
        return $this->belongsToMany(Science::class, 'message_science', 'message_id', 'science_id');
    }

    public function education()
    {
        return $this->belongsToMany(Education::class,'education_message', 'message_id','education_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class,'message_id','id');
    }

    public function meta()
    {
        return $this->hasOne(Meta::class,'message_id','id');
    }

    public function assistance()
    {
        return $this->belongsToMany(User::class);
    }

}
