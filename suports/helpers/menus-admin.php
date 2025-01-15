<?php

if (!function_exists('menusAdmin')):
    /**
     * @since 1.2.0
     * 
     * @return array
     */
    function menusAdmin(): array
    {
        $menus = [
            'dashboard' => [
                'path' => '/admin/dashboard',
                'title' => 'Dashboard' ,
                'icon' => 'bi bi-speedometer',
                'count' => null      
            ],
            'categories' => [
                'path' => '/admin/categories',
                'title' => 'Categorias',
                'icon' => 'bi bi-bookmarks-fill',
                'count' => null
            ],
            'locations' => [
                'path' => '/admin/locations',
                'title' => 'Locais',
                'icon' => 'bi bi-map-fill',
                'count' => null
            ],
            'reservations' => [
                'path' => '/admin/reservations',
                'title' => 'Reservas',
                'icon' => 'bi bi-calendar-event-fill',
                'count' => null
            ],
            'posts' => [
                'path'  => '/admin/posts',
                'title' => 'Posts' ,
                'icon'  => 'bi bi-pin-angle-fill',
                'count' => null
            ],
            'users' => [
                'path' => '/admin/users',
                'title' => 'Usuários' ,
                'icon' => 'bi bi-people-fill',
                'count' => null
            ],
            'gallery' => [
                'path' => '/admin/gallery',
                'title' => 'Galeria',
                'icon' => 'bi bi-images',
                'count' => null
            ],
            'banners' => [
                'path' => '/admin/banners',
                'title' => 'Banners',
                'icon' => 'bi bi-images',
                'count' => null
            ],
            'reports' => [
                'path' => '/admin/reports',
                'title' => 'Relatórios',
                'icon' => 'bi bi-file-text-fill',
                'count' => null
            ],
            'settings' => [
                'path' => '/admin/settings',
                'title' => 'Configurações',
                'icon' => 'bi bi-gear-fill',
                'count' => null
            ]
        ];

        return $menus;
    }
endif;
