<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MediaComment extends Model
{
    use HasFactory;

    protected $fillable = ['comment_id', 'file_name'];

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id','id');
    }

}
