<?php

if(!function_exists('routes')):
    /**
     * @since 1.2.0
     * 
     * @return array
     */
    function routes(): array
    {
        $slug_one = slug(2);
        $slug_two = slug(3);

        return [
            '/',
            '/admin',
            '/admin/dashboard',
            '/admin/users',
            '/admin/users/update',
            '/admin/users/create',
            '/admin/users/delete',
            '/admin/locations',
            '/admin/locations/create',
            '/admin/locations/update',
            '/admin/locations/delete',
            '/admin/categories',
            '/admin/categories/create',
            '/admin/categories/update',
            '/admin/categories/delete',
            '/admin/reservations',
            '/admin/reservations/create',
            '/admin/reservations/update',
            '/admin/reservations/delete',
            '/admin/gallery',
            '/admin/gallery/delete',
            '/admin/settings',
            '/admin/settings/update',
            '/admin/profile',
            '/admin/profile/update',
            '/admin/profile/update-avatar',
            '/admin/reports',
            '/admin/reports/generate-pdf',
            "/admin/posts",
            "/admin/posts/create",
            "/admin/posts/update",
            "/admin/posts/delete",
            "/admin/banners",
            "/admin/banners/create",
            "/admin/banners/update",
            "/admin/banners/delete",
            '/policies',
            '/login',
            '/login/create',
            '/login/logout',
            '/contact/create',
            "/category/{$slug_one}",
            "/location/{$slug_one}",
            "/location/create",
            "/schedules",
            "/news",
            "/news/{$slug_one}",

            '/api/gallery',
            '/api/gallery/create',
            '/api/hours',
            '/api/locations',
            '/api/clients',
            '/api/reservations/update',
            '/api/payments',
            "/reservation/protocol/{$slug_two}",
            "/reservation/protocol"
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

if(!function_exists('transBreadcrumps')):
    /**
     * @since 1.6.0
     * @param string $path
     * @return string
     */
    function transBreadcrumps(string $path): string 
    {
        $breadcrumps = [
            'admin' => 'admin',
            'dashboard' => 'painel',
            'users' => 'usuarios',
            'locations' => 'locais',
            'categories' => 'categorias',
            'reservations' => 'reservas',
            'gallery' => 'galeria',
            'settings' => 'configuracoes',
            'reports' => 'relatórios',
            'profile' => 'perfil'
        ];

        return isset($breadcrumps[$path]) ? $breadcrumps[$path] : $path;
    }
endif;
