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
     * @param int $id
     * @return string
     */
    public function generateToken(int $id): string
    {
        return $this->getToken($id);
    }

    /**
     * @since 1.7.0
     * 
     * @param int $id
     * @return string
     */
    private function getToken(int $id): string
    {
        $count = 8 - strlen($id);
        $code = 'P';

        for ($i = 0; $i < $count; $i++) { 
            $code .= '0';
        }

        return "{$code}{$id}";
    }
}
