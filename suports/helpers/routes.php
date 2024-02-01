<?php

if(!function_exists('routes')):
    /**
     * @since 1.2.0
     * 
     * @return array
     */
    function routes(): array
    {
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
            '/api/gallery',
            '/api/gallery/create',
        ];
    }
endif;

if(!function_exists('route')):
    /**
     * @since 1.4.0
     * 
     * @param string $path
     * @param bool $redirection
     * @return string|void
     */
    function route(string $path = '', bool $redirection = false)
    {
        $project_path = env('PROJECT_PATH');
        $path = $project_path . $path;

        if($redirection):
            return "Location: $path";
        endif;

        echo $path;
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
            unset($array[$count-1]);
        endif;

        array_push($array, $file);

        $path = implode('/', $array);

        return $path;
    }
endif;
