<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use App\Models\Userprof;
use App\Models\Science;
use App\Models\Usermeta;
use App\Models\Message;
use App\Models\Comment;
use App\Models\Testimonial;
use App\Models\Coach;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    use Notifiable, Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function userprof()
    {
        return $this->hasMany(Userprof::class,'user_id', 'id');
    }

    public function science()
    {
        return $this->belongsToMany(Science::class,'science_user', 'user_id','science_id');
    }

    public function meta()
    {
        return $this->hasOne(Usermeta::class);
    }

    public function role()
    {
        return $this->hasOne(Role::class);
    }

    public function setnotification()
    {
        return $this->hasOne(SetNotification::class);
    }

    public function message()
    {
        return $this->hasMany(Message::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function testimonial()
    {
        return $this->hasMany(Testimonial::class,'user_id','id');
    }

    public function testimonial_reviewer()
    {
        return $this->hasMany(Testimonial::class,'reviewer_id','id');
    }

    public function assistance_user()
    {
        return $this->belongsToMany(Message::class,'message_user','user_id','message_id');
    }

    public function coach()
    {
        return $this->belongsToMany(Coach::class);
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

}
