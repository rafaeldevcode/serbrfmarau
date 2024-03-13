<?php

namespace Src;

use Src\Models\Protocol;
use Src\Models\Reservation;
use Src\Models\Setting;
use Src\Models\Time;

class Cron
{
    public function handle()
    {
        $today = date('Y-m-d');
        $last_cron = !is_null(SETTINGS) && !empty(SETTINGS['last_cron']) ? SETTINGS['last_cron'] : $today;

        if(date('Y-m-d') > $last_cron):
            $reservation = new Reservation();
            $protocol = new Protocol();
            $schedules = new Time();

            $status = 'Finalizado';
            $reservations = $reservation
                ->where('date', '=', $last_cron)
                ->get();

            if($reservations):
                foreach($reservations as $item):
                    if($item->status == 'Pendente' || $item->status == 'Aprovado'):
                        $reservation = $reservation->find($item->id);
                        $reservation->update(['status' => $status]);
    
                        $protocol = $protocol->find($reservation->protocols()->data[0]->id);
                        $protocol->update([
                            'reservation_status' => $status
                        ]);
                
                        foreach($reservation->schedules()->data as $item):
                            $schedules->find($item->id)->update(['status' => $status]);
                        endforeach;
                    endif;
                endforeach;
            endif;

            $setting = new Setting();
            $current_setting = $setting->first();

            if(isset($current_setting)):
                $setting->find($current_setting->id)->update(['last_cron' => $today]);
            endif;
        endif;
    }
}
