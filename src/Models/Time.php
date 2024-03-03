<?php

namespace Src\Models;

class Time extends Model
{
    public $table = 'schedules';

    /**
     * @since 1.7.0
     * 
     * @return Reservation
     */
    public function reservation(): Reservation
    {
        return $this->belongsTo(Reservation::class, 'reservations', 'reservation_id');
    }

    /**
     * @since 1.7.0
     * 
     * @return Location
     */
    public function location(): Location
    {
        return $this->belongsTo(Location::class, 'locations', 'location_id');
    }
}
