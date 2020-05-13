<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes, Imageable;

    protected $appends = ['slug', 'parsedEventDate'];
    protected $fillable = [ 'title', 'description', 'location', 'price', 'eventdate', 'status', 'category_id', 'eventtype', 'website'];
    protected $with = ['images'];

    const STATUS_DRAFT = 0;
    const STATUS_PUBLISHED = 1;
    const STATUS_COMPLETED = 2;
    const STATUS_CANCELLED = 3;
 

    const STATUS_TYPE = [
        self::STATUS_DRAFT => 'Closed',
        self::STATUS_PUBLISHED => 'Published',
        self::STATUS_COMPLETED => 'Completed',
        self::STATUS_CANCELLED => 'Cancelled',
    ];

    const STATUSES = [
        self::STATUS_DRAFT,
        self::STATUS_PUBLISHED,
        self::STATUS_COMPLETED,
        self::STATUS_CANCELLED,

    ];
    const TYPE_OPEN = 0;
    const TYPE_REQUIRED = 1;


    const EVENT_TYPE = [
        self::TYPE_OPEN => 'Open Event',
        self::TYPE_REQUIRED => 'Required Participants',

    ];

    const TYPES = [
        self::TYPE_OPEN,
        self::TYPE_REQUIRED,
    ];

    protected $dates = [
        'eventdate',
    ];

    /**
     * Get event slug.
     *
     * @return string
     */
    public function slug()
    {
        return $this->id . '/' . Str::slug($this->title);
    }

    /**
     * Append slug to object property.
     *
     * @return string
     */
    public function getSlugAttribute()
    {
        return self::slug();
    }

    public function getparsedEventDateAttribute()
    {
        return Carbon::parse($this->eventdate)->toDateString();
    }

    public function getDefaultImage()
    {
        if($this->images()->first() != null) {
            return $this->images()->first()->path;
        } else {
            return 'https://placehold.co/300x400';
        }
    }

    /**
     * Return description excerpt.
     *
     * @return string
     */
    public function excerpt()
    {
        return Str::words($this->description,10);
    }


    /**
     * Get event slug with prefix.
     * @return string
     */
    public function slugWithPrefix()
    {
        return 'events/' . $this->id . '/' . Str::slug($this->title);
    }

    /**
     * Return true if authenticated user is event owner.
     *
     * @return bool
     */
    public function isOwner()
    {
        if(Auth::guest()) return false;

        return $this->isOwnedBy(Auth::user());
    }

    /**
     *event is belongs to a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * event has many applicants.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function applicants()
    {
        return $this->belongsToMany(User::class, 'event_user', 'event_id', 'userApplied_id')->withTimestamps();
    }

    
    /**
     * event has many likers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function likers()
    {
        return $this->belongsToMany(User::class, 'event_likers', 'event_id', 'user_id')->withTimestamps();
    }

        /**
     * event has many applicants.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function approvedapplicants()
    {
        return $this->belongsToMany(User::class, 'event_user_approval', 'event_id', 'userApprove_id')->withTimestamps();
    }


    /**
     * Query scope find events by title.
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
     * Query scope find events by description
     *
     * @param $query
     * @param $title
     * @return mixed
     */
    public static function scopeByDescriptionContains($query , $description)
    {
        return $query->where('description', 'LIKE', '%' . $description. '%');
    }
      /**
     * Query scope find events by description
     *
     * @param $query
     * @param $title
     * @return mixed
     */
    public static function scopeByLocationContains($query , $location)
    {
        return $query->where('location', 'LIKE', '%' . $location. '%');

    }

      /**
     * Query scope find events by description
     *
     * @param $query
     * @param $title
     * @return mixed
     */
    public static function scopeByCategoryContains($query , $category_id)
    {
        return $query->where('category_id', 'LIKE', '%' . $category_id. '%');
    }


    /**
     * Return true if user is event owner.
     *
     * @param User $user
     * @return bool
     */
    public function isOwnedBy(User $user)
    {
        return $this->user_id == $user->id;
    }

    /**
     * Get all statuses
     *
     * @return array
     */
    public static function getStatuses()
    {
        return self::STATUSES;
    }

     /**
     * Get all event types
     *
     * @return array
     */
    public static function getTypes()
    {
        return self::TYPES;
    }

    /**
     * Get published event.
     *
     * @param $query
     * @return mixed
     */
    public static function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED)->with('author', 'images')->orderBy('created_at', 'DESC')->get();
    }

    /**
     * An event may have many categories.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Returns true if event is published.
     *
     * @return bool
     */
    public function isPublished()
    {
        return $this->status == Event::STATUS_PUBLISHED;
    }

        /**
     * Returns true if event is closed.
     *
     * @return bool
     */
    public function isClosed()
    {
        return $this->status == Event::STATUS_DRAFT;
    }

          /**
     * Returns true if event is cancel.
     *
     * @return bool
     */
    public function isCancel()
    {
        return $this->status == Event::STATUS_CANCELLED;
    }

       /**
     * Returns true if event is closed.
     *
     * @return bool
     */
    public function isOpen()
    {
        return $this->eventtype == Event::TYPE_OPEN;
    }

          /**
     * Returns true if event is cancel.
     *
     * @return bool
     */
    public function isRequired()
    {
        return $this->eventtype == Event::TYPE_REQUIRED;
    }
}
