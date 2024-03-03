<?php

namespace Src\Models;

class Event extends Model
{
    public $table = 'events';

    /**
     * @since 1.7.0
     * 
     * @return Location
     */
    public function location(): Location
    {
        return $this->belongsTo(Location::class, 'locations', 'location_id');
    }

    /**
     * @since 1.7.0
     * 
     * @return Time
     */
    public function schedules(): Time
    {
        return $this->hasMany(Time::class, 'schedules', 'event_id');
    }

    /**
     * @since 1.7.0
     * 
     * @return Protocol
     */
    public function protocols(): Protocol
    {
        return $this->hasMany(Protocol::class, 'protocols', 'event_id');
    }
}
