<?php

namespace Src\Models;

class Protocol extends Model
{
    public $table = 'protocols';

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
     * @since 1.0.0
     * 
     * @return string
     */
    public function generateToken(): string
    {
        return bin2hex(random_bytes(64));
    }
}
