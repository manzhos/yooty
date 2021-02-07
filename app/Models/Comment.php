<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comment extends Model
{

    protected $guarded=[];
    /**
     * Get the owning commentable model.
     */
    public function commentable()
    {
        return $this->belongsTo(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function message()
    {
        return $this->belongsTo(Message::class);
    }

    public function media()
    {
        return $this->hasMany(MediaComment::class, 'comment_id','id');
    }

}
