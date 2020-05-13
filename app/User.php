<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phoneNum', 'address', 'user_type',
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

    public function isAdmin()   
     {        
        return $this->user_type;    
    }

    /**
     * A user may create many Events.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }

    /**
     * A user has many messages.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }


    /**
     * A user may apply for many events.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function appliedEvents()
    {
        return $this->belongsToMany(Event::class, 'event_user', 'userApplied_id', 'event_id')->withTimestamps();
    }

    
    /**
     * A user may apply for many events.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likedEvents()
    {
        return $this->belongsToMany(Event::class, 'event_likers', 'user_id', 'event_id')->withTimestamps();
    }

        /**
     * A user may apply for many events.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function approvalEvents()
    {
        return $this->belongsToMany(Event::class, 'event_user_approval', 'userApprove_id', 'event_id')->withTimestamps();
    }


    /**
     * Check if user has applied for the job.
     * @param Job $job
     * @return bool
     */
    public function hasAppliedEvent(Event $event)
    {
        return $this->appliedEvents()->where('event_id', $event->id)->exists();
    }
     /**
     * Check if user has applied for the job.
     * @param Job $job
     * @return bool
     */
    public function hasLikedEvent(Event $event)
    {
        return $this->likedEvents()->where('event_id', $event->id)->exists();
    }

    /**
     * Query scope find user by title.
     *
     * @param $query
     * @param $title
     * @return mixed
     */
    public static function scopeByTitleContains($query, $title)
    {
        return $query->where('title', 'LIKE', '%' . $title . '%');
    }
     
    /**
     * Return the avatar.
     *
     * @return string
     */
    public function getAvatar()
    {
        if($this->avatar_path != null) {
            $siteurl = 'http://localhost:8000/uploads/';
             
            return $siteurl . $this->avatar_path;
        } else {
            return "https://via.placeholder.com/150";
        }
    }
}
