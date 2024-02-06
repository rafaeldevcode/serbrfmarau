<?php

namespace Src\Models;

class Protocol extends Model
{
    public $table = 'protocols';

    /**
     * @since 1.7.0
     * 
     * @return Event
     */
    public function event(): Event
    {
        return $this->belongsTo(Event::class, 'events', 'event_id');
    }

    /**
     * @since 1.7.0
     * 
     * @return Client
     */
    public function client(): Client
    {
        return $this->belongsTo(Client::class, 'clients', 'client_id');
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
