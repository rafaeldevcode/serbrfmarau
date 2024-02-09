<?php

if(!function_exists('routes')):
    /**
     * @since 1.2.0
     * 
     * @return array
     */
    function routes(): array
    {
        $slug_category = slug(2);

        return [
            '/',
            '/admin/dashboard',
            '/admin/users',
            '/admin/users/update',
            '/admin/users/create',
            '/admin/users/delete',
            '/admin/clients',
            '/admin/clients/create',
            '/admin/clients/update',
            '/admin/clients/delete',
            '/admin/locations',
            '/admin/locations/create',
            '/admin/locations/update',
            '/admin/locations/delete',
            '/admin/categories',
            '/admin/categories/create',
            '/admin/categories/update',
            '/admin/categories/delete',
            '/admin/events',
            '/admin/events/create',
            '/admin/events/update',
            '/admin/events/delete',
            '/admin/gallery',
            '/admin/gallery/delete',
            '/admin/settings',
            '/admin/settings/update',
            '/admin/profile',
            '/admin/profile/update',
            '/admin/profile/update-avatar',

            '/policies',
            '/login',
            '/login/create',
            '/login/logout',
            '/contact/create',
            "/category/{$slug_category}",
            "/schedules",

            '/api/gallery',
            '/api/gallery/create',
            '/api/hours'
        ];
    }
endif;

if(!function_exists('route')):
    /**
     * @since 1.4.0
     * 
     * @param string $path
     * @param bool $redirection
     * @param bool $print
     * @return ?string
     */
    function route(string $path = '', bool $redirection = false, bool $print = true): ?string
    {
        $project_path = env('PROJECT_PATH');
        $path = $project_path . $path;

        if($redirection):
            return "Location: $path";
        endif;

        if($print):
            echo $path;
            return null;
        endif;

        return $path;
    }
endif;

if(!function_exists('getFileName')):
    /**
     * @since 1.4.0
     * @param string $path
     * @return string
     */
    function getFileName(string $path): string 
    {
        $method_posts = ['update', 'delete', 'create', 'update-avatar', 'logout'];
        $array = explode('/', $path);
        $count = count($array);
        $file = $array[$count-1];
        $file = in_array($file, $method_posts) ? $file : 'index';

        if(in_array($file, $method_posts)): 
            $count--;
            unset($array[$count]);
        endif;

        $array = verifySlug($array, $count, $file);

        $path = implode('/', $array);

        return $path;
    }
endif;

if(!function_exists('slug')):
    /**
     * @since 1.7.0
     * 
     * @param int $indice
     * @return string
     */
    function slug(int $indice): string
    {
        $path = path();
        $paths = explode('/', $path);
        
        if(isset($paths[$indice])):
            return $paths[$indice];
        endif;

        return '';
    }
endif;

if(!function_exists('verifySlug')):
    /**
     * @since 1.6.0
     * @param array $path
     * @param int $count
     * @param string $file
     * @return array
     */
    function verifySlug(array $array, int $count, string $file): array 
    {
        $last_path = $array[$count-1];

        unset($array[$count-1]);
        
        $path = implode('/', $array).'/show.php';

        if(is_file(__DIR__."/../..{$path}")):
            array_push($array, 'show');

            return $array;
        endif;

        array_push($array, $last_path);
        array_push($array, $file);

        return $array;
    }
endif;
