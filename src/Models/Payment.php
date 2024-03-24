<?php

namespace Src\Models;

class Payment extends Model
{
    public $table = 'payments';

    /**
     * @since 1.7.0
     * 
     * @return Reservation
     */
    public function reservation(): Reservation
    {
        return $this->belongsTo(Reservation::class, 'reservations', 'reservation_id');
    }
}
