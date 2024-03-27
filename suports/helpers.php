<?php

use Src\Models\Gallery;
use Src\Models\Location;
use Src\Models\Payment;
use Src\Models\Protocol;
use Src\Models\Reservation;
use Src\Models\Time;

require __DIR__.'/helpers/env.php';
require __DIR__.'/helpers/settings.php';
require __DIR__.'/helpers/requests.php';
require __DIR__.'/helpers/menus-admin.php';
require __DIR__.'/helpers/routes.php';

!defined('APP_VERSION') && define('APP_VERSION', '1.7.4');

date_default_timezone_set('America/Sao_Paulo');

if (! function_exists('asset')):
    /**
     * @since 1.0.0
     * 
     * @param string $route
     * @param bool $return
     * @return ?string
     */
    function asset(string $path, bool $return = false): ?string
    {
        $protocol = ((isset($_SERVER['HTTPS'])) && ($_SERVER['HTTPS'] == 'on') ? 'https' : 'http');
        $host = $_SERVER['HTTP_HOST'];
        $project_path = env('PROJECT_PATH');
        $assets_path = env('ASSETS_PATH');

        $url = "{$protocol}://{$host}{$project_path}{$assets_path}/{$path}";

        if($return): 
            return $url;
        else:
            echo $url;
            return null;
        endif;
    }
endif;

if (!function_exists('dd')):
    /**
     * @since 1.0.0
     * 
     * @return void
     */
    function dd(): void
    {
        echo '<pre>';
        array_map(function($x) {var_dump($x);}, func_get_args());
        die;
    }
endif;

if (!function_exists('loadHtml')):
    /**
     * @since 1.4.0
     * 
     * @param string $path
     * @param array $data
     * @return void
     */
    function loadHtml(string $path, array $data = []): void
    {
        extract($data);

        $path = substr($path, -4) == '.php' ? $path : "{$path}.php";

        require $path;
    }
endif;

if (!function_exists('path')):
    /**
     * @since 1.0.0
     * 
     * @return string
     */
    function path(): string
    {
        $project_path = env('PROJECT_PATH');

        if (($_SERVER['SERVER_NAME'] === 'localhost') ||
            ($_SERVER['SERVER_NAME'] === '127.0.0.1') ||
            ($_SERVER['SERVER_NAME'] === '0.0.0.0') ||
            ($_SERVER['SERVER_NAME'] == env('IP_ROOT'))
        ) :
            $path = $_SERVER['REQUEST_URI'];
        else :
            $path = $_SERVER['REQUEST_URI'];
        endif;

        $path = str_replace($project_path, '', $path);

        $path = explode('?', $path)[0];

        return rtrim($path, '/');
    }
endif;

if (!function_exists('getIconMessage')):
    /**
     * @since 1.5.0
     * 
     * @param ?string $type
     * @return string
     */
    function getIconMessage(?string $type): string
    {
        $icon = 'bi bi-question-circle-fill';

        switch ($type ) :
            case 'danger':
                $icon = 'bi bi-dash-circle-fill';
                break;
            case 'success':
                $icon = 'by bi-check-circle-fill';
                break;
            case 'warning':
                $icon = 'bi bi-exclamation-circle-fill';
                break;
            case 'secondary':
                $icon = 'bi bi-question-circle-fill';
            case 'info':
                $icon = 'bi bi-info-circle-fill';
                break;
        endswitch;

        return $icon;
    }
endif;

if (!function_exists('generateIdentifier')):
    /**
     * @since 1.7.0
     * 
     * @param int $lenght
     * @return string
     */
    function generateIdentifier(int $lenght): string
    {
        $number = '';

        for ($i = 0; $i < $lenght; $i++) {
            $number .= mt_rand(0, 9);
        }

        return $number;
    }
endif;

if (!function_exists('redirectIfTotalEqualsZero')):
    /**
     * @since 1.7.0
     * 
     * @param string $class
     * @param string $route
     * @param string $message
     * @return bool
     */
    function redirectIfTotalEqualsZero(string $class, string $route, string $message): bool
    {
        $class = new $class;
        
        if($class->count() == 0):
            session([
                'message' => $message,
                'type' => 'info'
            ]);

            header(route($route, true), true, 302);
            return true;
        endif;

        return false;
    }
endif;

if (!function_exists('getArraySelect')):
    /**
     * @since 1.7.0
     * 
     * @param ?array $object
     * @param string $key
     * @param string $value
     * @return array
     */
    function getArraySelect(?array $object, string $key, string $value): array
    {
        $data = [];

        if (is_null($object)) return $data;

        foreach($object as $object):
            $data = $data+[$object->{$key} => $object->{$value}];
        endforeach;

        return $data;
    }
endif;

if (!function_exists('getHoursReservation')):
    /**
     * @since 1.7.0
     * 
     * @param ?int $location_id
     * @param ?string $date
     * @param ?int $reservation_id
     * @param ?string $day
     * @param string $block_previous
     * @return array
     */
    function getHoursReservation(?int $location_id = null, ?string $date = null, ?int $reservation_id = null, ?string $day = null, string $block_previous = 'true'): array
    {
        if ($location_id === 0) {
            return [
                'hours' => []
            ];
        }

        $location = new Location();
        $schedules = new Time();
        $reservation = new Reservation();

        $current_hour = date('H:i');
        $current_date = date('Y-m-d');
        $reservation_schedules = [];
        $data = [
            'hours' => [],
        ];

        if(! is_null($reservation_id)):
            $reservation = $reservation->find($reservation_id);
            $reservation_schedules = $reservation->data?->date == $date ? getArraySelect($reservation->schedules()->data, 'id', 'hour') : [];
        endif;

        $location = $location->find($location_id);

        if(empty($date)):
            $schedules = $schedules->where('location_id', '=', $location_id)->where('day', '=', $day)->where('status', '!=', 'Reprovado')->get(['id', 'hour']);
        else:
            $schedules = $schedules->where('date', '=', $date)->where('location_id', '=', $location_id)->where('status', '!=', 'Reprovado')->orWhere('day', '=', date('l', strtotime($date)))->get(['id', 'hour', 'location_id']);
            $schedules = filterSchedules($schedules, $location_id);
        endif;

        $schedules = getArraySelect($schedules, 'id', 'hour');

        if ($location->data):
            $opening_days = json_decode($location->data->opening_days, true);

            if(in_array($day, $opening_days) || in_array(date('l', strtotime($date)), $opening_days)):
                $opening_date = getOpeningDate($location->data->opening);
                $active_hours = generateTimeBlocks($location->data->start_hour, $location->data->end_hour);
            else:
                $active_hours = [];
            endif;

            $price = empty($day) 
                ? json_decode($location->data->prices, true)[translateDayWeek(date('l', strtotime($date)))] 
                : json_decode($location->data->prices, true)[translateDayWeek($day)];

            $data['price'] = $price;
            $data['start_hour'] = $location->data->start_hour;
            $data['end_hour'] = $location->data->end_hour;
        else:
            $opening_date = date('Y-m-d');
            $active_hours = [];
        endif;

        $schedules = array_diff($schedules, $reservation_schedules);

        if($block_previous === 'true'):
            if(! empty($date) && isset($opening_date) && $opening_date > $date && date('Y-m-d') <= $date):
                $active_hours = array_diff($active_hours, $schedules);
            elseif(empty($date) && in_array($day, $opening_days)):
                $active_hours = array_diff($active_hours, $schedules);
            else:
                $active_hours = [];
                $data['message'] = 'Horários ainda não liberados pelo sistema, para mais informações entre em contato via WhatsApp!';
            endif;
        else:
            $active_hours = array_diff($active_hours, $schedules);
        endif;

        for ($i = 0; $i < 24; $i++) :
            $hour_one = strlen($i) == 1 ? "0{$i}:00" : "{$i}:00";
            $hour_two = strlen($i) == 1 ? "0{$i}:30" : "{$i}:30";

            if($block_previous === 'true' && $current_date === $date):
                $blocked_one = in_array($hour_one, $active_hours) && $hour_one > $current_hour ? false : true;
                $blocked_two = in_array($hour_two, $active_hours) && $hour_two > $current_hour ? false : true;
            else:
                $blocked_one = in_array($hour_one, $active_hours) ? false : true;
                $blocked_two = in_array($hour_two, $active_hours) ? false : true;
            endif;

            if ($block_previous === 'false'):
                $checked_one = in_array($hour_one, $schedules) ? true : false;
                $checked_two = in_array($hour_two, $schedules) ? true : false;
            else:
                $array_verify = is_null($reservation_id) ? $schedules : $reservation_schedules;
                
                $checked_one = in_array($hour_one, $array_verify) ? true : false;
                $checked_two = in_array($hour_two, $array_verify) ? true : false;
            endif;

            $blocked_one = $checked_one && $location->data->type == 'period' ? true : $blocked_one;
            $blocked_two = $checked_two && $location->data->type == 'period' ? true : $blocked_two;

            array_push($data['hours'], [
                'hour' => $hour_one,
                'blocked' => $blocked_one,
                'checked' => $checked_one
            ]);
            array_push($data['hours'], [
                'hour' => $hour_two,
                'blocked' => $blocked_two,
                'checked' => $checked_two
            ]);
        endfor;

        return $data;
    }
endif;

if (!function_exists('generateTimeBlocks')):
    /**
     * @since 1.7.0
     * 
     * @param string $start
     * @param string $end
     * @return array
     */
    function generateTimeBlocks(string $start, string $end): array
    {
        $blocks = [];
        $currentTime = $start;

        while ($currentTime < $end) :
            $blocks[] = $currentTime;
            $currentTime = date('H:i', strtotime($currentTime . '+30 minutes'));
        endwhile;

        $blocks[] = $end;

        return $blocks;
    }
endif;

if (!function_exists('getOpeningDate')):
    /**
     * @since 1.7.0
     * 
     * @param string $date
     * @return string
     */
    function getOpeningDate(string $date): string
    {
        $current_date = new DateTime();
        $current_date->add(new DateInterval($date));
        $current_date->modify('+1 day');
        $date_result = $current_date->format('Y-m-d');

        return $date_result;
    }
endif;

if (!function_exists('getBadgeReservationStatus')):
    /**
     * @since 1.7.0
     * 
     * @param string $status
     * @return string
     */
    function getBadgeReservationStatus(string $status): string
    {
        return match ($status) {
            'Pendente' => 'secondary',
            'Aprovado' => 'success',
            'Reprovado' => 'danger',
            'Finalizado' => 'info'
        };
    }
endif;

if (!function_exists('pickDaysOfTheWeek')):
    /**
     * @since 1.7.0
     * 
     * @return array
     */
    function pickDaysOfTheWeek(): array
    {
        return [
            'Domingo',
            'Segunda',
            'Terça',
            'Quarta',
            'Quinta',
            'Sexta', 
            'Sábado'
        ];
    }
endif;

if (!function_exists('translateDayWeek')):
    /**
     * @since 1.7.0
     * 
     * @param string $day
     * @return string
     */
    function translateDayWeek(string $status): string
    {
        return match ($status) {
            'Sunday' => 'Domingo',
            'Monday' => 'Segunda',
            'Tuesday' => 'Terça',
            'Wednesday' => 'Quarta',
            'Thursday' => 'Quinta',
            'Friday' => 'Sexta',
            'Saturday' => 'Sábado'
        };
    }
endif;

if (!function_exists('getHoursByPeriod')):
    /**
     * @since 1.7.0
     * 
     * @param string $period
     * @return array
     */
    function getHoursByPeriod(string $period): array
    {
        $hours = [];
        $periods = [
            'Manhã' => [
                'start' => 8,
                'end' => 13
            ],
            'Tarde' => [
                'start' => 13,
                'end' => 18
            ],
            'Noite' => [
                'start' => 18,
                'end' => 23
            ]
        ];

        for ($i = 0; $i < 24; $i++):
            if($i >= $periods[$period]['start'] && $i <= $periods[$period]['end']):
                $hour_one = '';
                $hour_two = '';

                if ($i < 10) {
                    $hour_one = "0{$i}:00";
                    $hour_two = "0{$i}:30";
                } else {
                    $hour_one = "{$i}:00";
                    $hour_two = "{$i}:30";
                }

                array_push($hours, $hour_one);
                array_push($hours, $hour_two);
            endif;
        endfor;

        return $hours;
    }
endif;

if (!function_exists('getHours')):
    /**
     * @since 1.7.0
     * 
     * @return array
     */
    function getHours(): array
    {
        $hours = [];

        for ($i = 0; $i < 24; $i++):
            if ($i < 10) {
                $hour_one = "0{$i}:00";
                $hour_two = "0{$i}:30";
            } else {
                $hour_one = "{$i}:00";
                $hour_two = "{$i}:30";
            }

            array_push($hours, $hour_one);
            array_push($hours, $hour_two);
        endfor;

        return $hours;
    }
endif;

if (!function_exists('addHour')):
    function addHour(array $current_hours): array
    {
        $last_hour = $current_hours[array_keys($current_hours)[0]+1];

        $hours = getHours();
        $filter = array_filter($hours, function ($hour) use($last_hour) {
            return $hour === $last_hour;
        });

        array_push($current_hours, $hours[array_keys($filter)[0]+1]);

        return $current_hours;
    }
endif;

if (!function_exists('getImagePath')):
    /**
     * @since 1.7.0
     * 
     * @param int $id
     * @return ?string
     */
    function getImagePath(int $id): ?string
    {
        $gallery = new Gallery();
        $thumbnail = $gallery->find($id);

        return $thumbnail->data?->file;
    }
endif;

if (!function_exists('getImagesLocation')):
    /**
     * @since 1.7.0
     * 
     * @param int $id
     * @return ?array
     */
    function getImagesLocation(int $id): ?array
    {
        $location = new Location();
        $location = $location->find($id);

        return $location->images()->data;
    }
endif;

if (!function_exists('getLocationName')):
    /**
     * @since 1.7.0
     * 
     * @param int $id
     * @return ?string
     */
    function getLocationName(int $id): ?string
    {
        $location = new Location();
        $location = $location->find($id);

        return $location->data?->name;
    }
endif;

if (!function_exists('getBtweenHours')):
    /**
     * @since 1.7.0
     * 
     * @param int $id
     * @return ?string
     */
    function getBtweenHours(int $id): ?string
    {
        $reservations = new Reservation();
        $reservation = $reservations->find($id);

        $hours = addHour(getArraySelect($reservation->schedules()->data, 'id', 'hour'));
        $keys = array_keys($hours);

        return "{$hours[$keys[0]]} Às {$hours[$keys[count($keys)-1]]}";
    }
endif;

if (!function_exists('getProtocol')):
    /**
     * @since 1.7.0
     * 
     * @param int $id
     * @return ?string
     */
    function getProtocol(int $id): ?string
    {
        $reservations = new Reservation();
        $reservation = $reservations->find($id);

        return $reservation->protocols()->data[0]->token;
    }
endif;

if (!function_exists('getPrice')):
    /**
     * @since 1.7.0
     * 
     * @param ?string $prices
     * @return float
     */
    function getPrice(?string $prices, ?string $date, ?string $day): float
    {
        $prices = json_decode($prices, true);
        $day = is_null($day) ? date('l', strtotime($date)) : $day;

        return floatval($prices[translateDayWeek($day)]);
    }
endif;

if (!function_exists('getLabelOpeningDay')):
    /**
     * @since 1.7.0
     * 
     * @param string $openingDay
     * @return string
     */
    function getLabelOpeningDay(string $openingDay): string
    {
        return match ($openingDay) {
            'P1D' => '1 Dia',
            'P1W' => '1 Semana',
            'P1M' => '1 Mês',
            'P1Y' => '1 Ano'
        };
    }
endif;

if (!function_exists('filterReservations')):
    /**
     * @since 1.7.0
     * 
     * @param Reservation $reservation
     * @return string
     */
    function filterReservations(Reservation $reservation)
    {
        $requests = requests();

        if(!empty($requests->protocol)):
            $protocol = new Protocol();
            $protocol = $protocol->where('token', '=', $requests->protocol)->first();
            
            $reservation = $reservation->where('id', '=', $protocol->reservation_id);
        endif;

        if(isset($requests->search)):
            $reservation = $reservation->where('name', 'LIKE', "%{$requests->search}%");
        endif;

        if(isset($requests->status) && !empty($requests->status)):
            $reservation = $reservation->where('status', '=', $requests->status);
        endif;

        if(isset($requests->reservation_type) && !empty($requests->reservation_type)):
            $reservation = $reservation->where('type', '=', $requests->reservation_type);
        endif;

        if(isset($requests->date) && !empty($requests->date)):
            $reservation = $reservation->where('date', '>=', date('Y-m-d'), 'start_date');
            $reservation = $reservation->where('date', '<=', getOpeningDate($requests->date), 'end_date');
        endif;
    
        return $reservation->paginate(20);
    }
endif;

if (!function_exists('filterSchedules')):
    /**
     * @since 1.7.0
     * 
     * @param array $schedules
     * @param string $location_id
     */
    function filterSchedules(?array $schedules, int $location_id): ?array
    {
        if(is_null($schedules)) return null;

        foreach($schedules as $indice => $time):
            if($time->location_id !== $location_id):
                unset($schedules[$indice]);
            endif;
        endforeach;

        return $schedules;
    }
endif;

if (!function_exists('generatePayments')):
    /**
     * @since 1.7.0
     * 
     * @param ?string $type
     * @param ?string $date
     * @param array
     */
    function generatePayments(?string $type, ?string $date): array
    {
        $date = is_null($date) ? date('Y-m-d') : $date;
        $payments = [];

        if(! isset($type) || $type === 'Normal'):
            $week = date('W', strtotime($date));
            $month = date('n', strtotime($date));
            $year = date('Y', strtotime($date));
            
            array_push($payments, "{$year}:{$month}:{$week}");
        else:
            $current_week = date('W', strtotime($date));
            $month = date('n', strtotime($date));
            $year = date('Y', strtotime($date));
            $weeks = array_filter(getWeeksMonth($year, $month), function ($item) use($current_week) {
                return (int)$item >= (int) $current_week;
            });

            foreach($weeks as $week):
                array_push($payments, "{$year}:{$month}:{$week}");
            endforeach;
        endif;

        return $payments;
    }
endif;

if (!function_exists('getPaymentIds')):
    /**
     * @since 1.7.0
     * 
     * @param int $reservation_id
     * @param string $type
     * @return array
     */
    function getPaymentIds(int $reservation_id): array
    {
        $payment = new Payment();
        $payments = $payment->where('reservation_id', '=', $reservation_id)->get();
        $payments = getArraySelect($payments, 'id', 'status');

        return $payments;
    }
endif;

if (!function_exists('getWeeksMonth')):
    /**
     * @since 1.7.0
     * 
     * @param string $year
     * @param string $month
     * @return array
     */
    function getWeeksMonth(string $year, string $month): array
    {
        $weeks = [];

        for ($day = 1; $day <= cal_days_in_month(CAL_GREGORIAN, $month, $year); $day++) {
            $week = date('W', strtotime("$year-$month-$day"));

            $weeks[$week][] = "$year-$month-$day";
        }

        return array_keys($weeks);
    }
endif;

if (!function_exists('createPayments')):
    /**
     * @since 1.7.0
     * 
     * @param int $reservation_id
     * @return void
     */
    function createPayments (int $reservation_id): void
    {
        $payment = new Payment();
        $date = date('Y-m-d');
        $month = date('n', strtotime($date));
        
        $payment = $payment->where('token', 'LIKE', "%:{$month}:%")
            ->where('reservation_id', '=', $reservation_id)
            ->first();

        if(!isset($payment)):
            $payments = generatePayments('Fixo', '2024-04-01');
            
            foreach($payments as $token):
                (new Payment)->create([
                    'token' => $token,
                    'status' => 'off',
                    'reservation_id' => $reservation_id
                ]);
            endforeach;
        endif;
    }
endif;

!defined('SETTINGS') && define('SETTINGS', (array)getSiteSettings());
