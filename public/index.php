<?php
    require __DIR__ .'/../bootstrap/bootstrap.php';

    $path = empty(path()) ? '/' : path();
    $routes = routes();
    $maintenance = is_null(SETTINGS) ? 'on' : SETTINGS['maintenance'];
    $construction = is_null(SETTINGS) ? 'on' : SETTINGS['construction'];

    if(strpos($path, '/admin') !== false && !autenticate()):
        if($path == '/login'):

            loadHtml(__DIR__.getFileName($path));
        else:

            return header(route('/login', true), true, 302);
        endif;
    else:
        if(in_array($path, $routes)):
            if(!autenticate() && strpos($path, '/login') === false):
                if($construction === 'on'):
                    loadHtml(__DIR__ . '/../resources/client/construction');
                    die;
                elseif($maintenance === 'on'):
                    loadHtml(__DIR__ . '/../resources/client/maintenance');
                    die;
                endif;
            endif;

            loadHtml(__DIR__.'/..'.getFileName($path));
        else:
            
            abort(404, 'Not Found', 'danger');
        endif;
    endif;
