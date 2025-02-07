<?php

use Src\Models\AccessToken;
use Src\Models\Setting;
use Src\Models\Gallery;

if (!function_exists('normalizeBreadcrumps')):
    /**
     * @since 1.1.0
     * 
     * @return array
     */
    function normalizeBreadcrumps(): array
    {
        $breadcrumps_normalize = [];
        $breadcrumps = explode('/', path());
        $breadcrumps = array_filter($breadcrumps);
        $path = '';

        foreach($breadcrumps as $breadcrump):
            if(substr($breadcrump, 0, 1) !== '?'):
                $path = "{$path}/{$breadcrump}";

                array_push($breadcrumps_normalize, [
                    'path' => $path,
                    'title' => $breadcrump
                ]);
            endif;
        endforeach;

        return $breadcrumps_normalize;
    }
endif;

if (!function_exists('saveImage')):
    /**
     * @since 1.2.0
     * 
     * @param string $image_key
     * @param string|null $old_file
     * @param int|null $indice
     * @return stdClass|null
     */
    function saveImage(string $image_key, string|null $old_file, int|null $indice = null): stdClass|null
    {
        $gallery = new Gallery();
        
        if(!is_null($indice)):
            $file = ['images' => [
                'name' => $_FILES[$image_key]['name'][$indice],
                'type' => $_FILES[$image_key]['type'][$indice],
                'tmp_name' => $_FILES[$image_key]['tmp_name'][$indice],
                'error' => $_FILES[$image_key]['error'][$indice],
                'size' => $_FILES[$image_key]['size'][$indice]
            ]];
        else:
            $file = $_FILES;
        endif;

        if(isset($file['images']) && !empty($file['images']['name'])):
            $year = date('Y');
            $month = date('m');
            createDir(__DIR__."/../../public/assets/images/uploads/{$year}/{$month}/", 0755);

            $file_name = bin2hex(random_bytes(25));
            $extencion = explode('/', $file['images']['type'])[1];
            $extencion = str_replace('+xml', '', $extencion);
            $file_path = "uploads/{$year}/{$month}/{$file_name}.{$extencion}";

            $name = str_replace(['.jpeg', '.jpg', '.webp', '.svg', '.svg+xml', '.png'], '', $file['images']['name']);
            $name = str_replace(['_', '-'], ' ', $name);

            $gallery = $gallery->create([
                'name' => $name,
                'file' => $file_path,
                'user_id' => $_SESSION['user_id'],
                'size' => $file['images']['size']
            ]);

            move_uploaded_file($file['images']['tmp_name'], __DIR__."/../../public/assets/images/{$file_path}");

            return $gallery;
        endif;

        return null;
    }
endif;

if (!function_exists('getSiteSettings')) :
    /**
     * @since 1.0.0
     * 
     * @return stdClass|null
     */
    function getSiteSettings(): stdClass|null
    {
        if(!isset($_SESSION)):
            session_start();
        endif;

        if(isset($_SESSION['site_settings'])):

            $settings = $_SESSION['site_settings'];
        else:
            $settings = new Setting();
            $gallery = new Gallery();
            $settings = $settings->first();

            $settings->site_favicon = isset($settings->site_favicon) ? $gallery->find($settings->site_favicon)->data->file : null;
            $settings->site_logo_main = isset($settings->site_logo_main) ? $gallery->find($settings->site_logo_main)->data->file : null;
            $settings->site_logo_secondary = isset($settings->site_logo_secondary) ? $gallery->find($settings->site_logo_secondary)->data->file : null;
            $settings->site_bg_login = isset($settings->site_bg_login) ? $gallery->find($settings->site_bg_login)->data->file : null;

            session(['site_settings' => $settings]);
        endif;
        
        return $settings;
    }
endif;

if (!function_exists('getDates')) :
    /**
     * @since 1.0.0
     * 
     * @param string $start_date
     * @param string $end_date
     * @return array
     */
    function getDates(string $start_date, string $end_date): array
    {
        if(empty($start_date) && empty($end_date)):

            $dates = [];
        elseif(empty($start_date) && !empty($end_date)):

            $dates = ["{$end_date} 00:00:00", "{$end_date} 23:59:59"];
        elseif(!empty($start_date) && empty($end_date)):

            $dates = ["{$start_date} 00:00:00", "{$start_date} 23:59:59"];
        elseif(!empty($start_date) && !empty($end_date)):

            $dates = ["{$start_date} 00:00:00", "{$end_date} 23:59:59"];
        endif;

        return $dates;
    }
endif;

if (!function_exists('getStates')) :
    /**
     * @since 1.0.0
     * 
     * @return array
     */
    function getStates(): array
    {
        return [
            ""   => "---",
            "AC" => "Acre",
            "AL" => "Alagoas",
            "AP" => "Amapá",
            "AM" => "Amazonas",
            "BA" => "Bahia",
            "CE" => "Ceará",
            "ES" => "Espírito Santo",
            "GO" => "Goiás",
            "MA" => "Maranhão",
            "MT" => "Mato Grosso",
            "MS" => "Mato Grosso do Sul",
            "MG" => "Minas Gerais",
            "PA" => "Pará",
            "PB" => "Paraíba",
            "PR" => "Paraná",
            "PE" => "Pernambuco",
            "PI" => "Piauí",
            "RJ" => "Rio de Janeiro",
            "RN" => "Rio Grande do Norte",
            "RS" => "Rio Grande do Sul",
            "RO" => "Rondônia",
            "RR" => "Roraima",
            "SC" => "Santa Catarina",
            "SP" => "São Paulo",
            "SE" => "Sergipe",
            "TO" => "Tocantins",
            "DF" => "Distrito Federal"
        ];
    }
endif;

if (!function_exists('getAvatars')):
    /**
     * @since 1.0.0
     * 
     * @return array
     */
    function getAvatars(): array
    {
        return [
            1 => [
                "src" => "default.png",
                "alt" => "Default"
            ],
            2 => [
                "src" => "ant_man.png",
                "alt" => "Ant Man"
            ],
            3 => [
                "src" => "avangers.png",
                "alt" => "Avangers"
            ],
            4 => [
                "src" => "black_hawk.png",
                "alt" => "Black Hawk"
            ],
            5 => [
                "src" => "black_panther.png",
                "alt" => "Black Panther"
            ],
            6 => [
                "src" => "black_widow.png",
                "alt" => "Black Widow"
            ],
            7 => [
                "src" => "captain_america.png",
                "alt" => "Captain America"
            ],
            8 => [
                "src" => "captain_marvel.png",
                "alt" => "Captain Marvel"
            ],
            9 => [
                "src" => "daredevil.png",
                "alt" => "Daredevil"
            ],
            10 => [
                "src" => "elektra.png",
                "alt" => "Eleketra"
            ],
            11 => [
                "src" => "ghost_rider.png",
                "alt" => "Ghost Rider"
            ],
            12 => [
                "src" => "hulk.png",
                "alt" => "Hulk"
            ],
            13 => [
                "src" => "iron_first.png",
                "alt" => "Iron First"
            ],
            14 => [
                "src" => "iron_man.png",
                "alt" => "Iron Man"
            ],
            15 => [
                "src" => "jessica_jones.png",
                "alt" => "Jessica Jones"
            ],
            16 => [
                "src" => "luke_cage.png",
                "alt" => "Luke Cage"
            ],
            17 => [
                "src" => "moon_knight.png",
                "alt" => "Moon Knight"
            ],
            18 => [
                "src" => "nova.png",
                "alt" => "Nova"
            ],
            19 => [
                "src" => "punisher.png",
                "alt" => "Punisher"
            ],
            20 => [
                "src" => "spider_gwen.png",
                "alt" => "Spider Gwen"
            ],
            21 => [
                "src" => "spider_ham.png",
                "alt" => "Spider Ham"
            ],
            22 => [
                "src" => "spider_man.png",
                "alt" => "Spider Man"
            ],
            23 => [
                "src" => "vision.png",
                "alt" => "Vision"
            ],
            24 => [
                "src" => "wasp.png",
                "alt" => "Wasp"
            ]
        ];
    }
endif;

if (!function_exists('getPreloaders')):
    /**
     * @since 1.0.0
     * 
     * @return array
     */
    function getPreloaders(): array
    {
        return [
            1 => [
                "src" => "preloader_default.gif",
                "alt" => "Preloader Default"
            ],
            2 => [
                "src" => "preloader_one.gif",
                "alt" => "Preloader One"
            ],
            3 => [
                "src" => "preloader_two.gif",
                "alt" => "Preloader Two"
            ],
            4 => [
                "src" => "preloader_three.gif",
                "alt" => "Preloader Three"
            ],
            5 => [
                "src" => "preloader_four.gif",
                "alt" => "Preloader Four"
            ],
            6 => [
                "src" => "preloader_five.gif",
                "alt" => "Preloader Five"
            ],
            7 => [
                "src" => "preloader_six.gif",
                "alt" => "Preloader Six"
            ],
            8 => [
                "src" => "preloader_seven.gif",
                "alt" => "Preloader Seven"
            ],
            9 => [
                "src" => "preloader_eight.gif",
                "alt" => "Preloader Eight"
            ],
            10 => [
                "src" => "preloader_nine.gif",
                "alt" => "Preloader Nine"
            ],
            11 => [
                "src" => "preloader_teen.gif",
                "alt" => "Preloader Teen"
            ]
        ];
    }
endif;

if(!function_exists('getOnly')):
    /**
     * @since 1.0.0
     * 
     * @param array $only
     * @param array $data
     * @param bool $contains
     * @return array
     */
    function getOnly(array $only, array $data, bool $contains = true): array
    {
        $keys = [];
        $values = [];

        foreach($data as $indice => $value):
            if($contains):
                if(in_array($indice, $only)):
                    array_push($keys, $indice);
                    array_push($values, $value);
                endif;
            else:
                if(!in_array($indice, $only)):
                    array_push($keys, $indice);
                    array_push($values, $value);
                endif;
            endif;
        endforeach;

        return array_combine($keys, $values);
    }
endif;

if(!function_exists('normalizeSlug')):
    /**
     * @since 1.1.0
     * 
     * @param string $title
     * @param string $slug
     * @return string
     */
    function normalizeSlug(string $title, string $slug): string
    {
        $slug = empty($slug) ? $title : $slug;
        $slug = strtolower($slug);
        $slug = str_replace([' ', '.', ',', '&'], '-', $slug);
        $slug = preg_replace(["/(á|à|ã|â|ä)/", "/(Á|À|Ã|Â|Ä)/", "/(é|è|ê|ë)/", "/(É|È|Ê|Ë)/", "/(í|ì|î|ï)/", "/(Í|Ì|Î|Ï)/", "/(ó|ò|õ|ô|ö)/", "/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/", "/(Ú|Ù|Û|Ü)/", "/(ñ)/", "/(Ñ)/", "/(ç)/", "/(Ç)/", "/(\$)/"], explode(" ","a A e E i I o O u U n N c C"), $slug);

        return $slug;
    }
endif;

if(!function_exists('getExcerpt')):
    /**
     * @since 1.9.1
     *
     * @param ?string $content
     * @param int $length
     * @return ?string
     */
    function getExcerpt(?string $content, int $lenght = 200): ?string
    {
        if(is_null($content)) return $content;

        $paragraphs = strip_tags($content, '<p>');
        $paragraph = preg_split('/<p[^>]*>/', $paragraphs);
        $paragraph = explode('</p>', $paragraph[1]);

        $excerpt = strlen($paragraph[0]) > $lenght ? substr($paragraph[0], 0, $lenght).'...' : $paragraph[0];

        return html_entity_decode($excerpt);
    }
endif;

if(!function_exists('createDir')):
    /**
     * @since 1.2.0
     * 
     * @param string $path
     * @param int $permission
     * @return bool
     */
    function createDir(string $path, int $permission): bool
    {
        $success = false;

        if(!is_dir($path)):
            if(mkdir($path, $permission, true)):
                $success = true;
            else:
                $success = false;
            endif;
        else:
            $success = true;
        endif;

        return $success;
    }
endif;

if(!function_exists('deleteDir')):
    /**
     * @since 1.2.0
     * 
     * @param string $path
     * @return string
     */
    function deleteDir(string $path): string
    {
        $message = '';

        if(file_exists($path)):
            if(unlink($path)):
                $message = 'deleted';
            else:
                $message = 'not deleted';
            endif;
        else:
            $message = 'not found';
        endif;

        return $message;
    }
endif;

if(!function_exists('extractIdsLoggedUsers')):
    /**
     * @since 1.6.0
     * 
     * @return array
     */
    function extractIdsLoggedUsers(): array
    {
        $tokens = new AccessToken();
        $tokens = $tokens->get();
        $ids = [];

        foreach($tokens as $token):
            array_push($ids, $token->user_id);
        endforeach;
        
        return $ids;
    }
endif;
