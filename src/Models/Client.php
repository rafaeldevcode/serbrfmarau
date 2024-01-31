<?php

namespace Src\Models;

class Client extends Model
{
    public $table = 'clients';

    /**
     * @since 1.7.0
     * 
     * @return Event
     */
    public function events(): Event
    {
        return $this->hasMany(Event::class, 'events', 'client_id');
    }
}
