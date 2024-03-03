<?php

namespace Src\Models;

class Reservation extends Model
{
    public $table = 'reservations';

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
        return $this->hasMany(Time::class, 'schedules', 'reservation_id');
    }

    /**
     * @since 1.7.0
     * 
     * @return Protocol
     */
    public function protocols(): Protocol
    {
        return $this->hasMany(Protocol::class, 'protocols', 'reservation_id');
    }
}
