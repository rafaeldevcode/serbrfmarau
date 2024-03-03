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
            'events' => [
                'path' => '/admin/events',
                'title' => 'Eventos',
                'icon' => 'bi bi-calendar-event-fill',
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
