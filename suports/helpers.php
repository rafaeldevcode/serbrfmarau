<?php

require __DIR__.'/helpers/env.php';
require __DIR__.'/helpers/settings.php';
require __DIR__.'/helpers/requests.php';
require __DIR__.'/helpers/menus-admin.php';
require __DIR__.'/helpers/routes.php';

!defined('APP_VERSION') && define('APP_VERSION', '1.5.0');

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
     * @param array $object
     * @param string $key
     * @param string $value
     * @return array
     */
    function getArraySelect(array $object, string $key, string $value): array
    {
        $data = [];

        foreach($object as $object):
            $data = $data+[$object->{$key} => $object->{$value}];
        endforeach;

        return $data;
    }
endif;

!defined('SETTINGS') && define('SETTINGS', (array)getSiteSettings());
