<?php

namespace Src\Email;

class BodyEmail
{
    /**
     * @since 1.0.0
     * 
     * @param array $data
     * @param string $title
     * @return string
     */
    public static function contact(array $data, string $title = ''): string
    {
        $message = <<<EOT
            <div style="padding: 1rem; background: #ffffff; border-radius: 5px; color: #CAB44B;">
                <ul style="list-style: none; margin: 0;">
                    <li><strong>Nome</strong>: {$data['name']}</li>
                    <li><strong>Email</strong>: {$data['email']}</li>
                    <li style="margin-top: 20px;">{$data['message']}</li>
                </ul>
            </div>
        EOT;

        return self::getLayout($message, $title);
    }

    /**
     * @since 1.7.0
     * 
     * @param string $status
     * @param string $hash
     * @param string $title
     * @param string $type
     * @return string
     */
    public static function protocol(string $status, string $hash, string $title = '', string $type = 'create'): string
    {
        $protocol = route("/reservations/protocol?protocol={$hash}", false, false);
        $copy = !is_null(SETTINGS) && !empty(SETTINGS['copyright']) ? SETTINGS['copyright'] : '';
        $site = !is_null(SETTINGS) && !empty(SETTINGS['site_name']) ? SETTINGS['site_name'] : '';
        $text = $type === 'create'
            ? "Olá, aqui é da equipe da <strong>{$site}</strong>, este email é para comunicar que seu horário foi reservado e está em processo de aprovação. Você receberá um novo email quando o mesmo for aprovado."
            : "Olá, aqui é da equipe da <strong>{$site}</strong>, este email é para comunicar que seu horário foi atualizado para: <strong>{$status}</strong>.";

        $message = <<<EOT
            <div style="padding: 1rem; background: #ffffff; border-radius: 5px; color: #1E3E87;">
                <p>{$text}</p>
                <p><strong>Protocolo: </strong><a href="{$protocol}">Acessar link</a></p>
            </div>

            <div style="padding: 1rem; background: #1E3E87; margin-top: 20px; color: #ffffff; text-align: center;">
                <p>{$copy}</p>
            </div>
        EOT;

        return self::getLayout($message, $title);
    }

    /**
     * @since 1.7.0
     * 
     * @param string $slot
     * @param string $title
     * @return string
     */
    private static function getLayout(string $slot, string $title): string
    {
        $copy = !is_null(SETTINGS) && !empty(SETTINGS['copyright']) ? SETTINGS['copyright'] : '';

        return <<<EOT
            <!DOCTYPE html>
            <html lang="pt-BR">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
            </head>
            <body style="padding: 1.4rem; background: #CAB44B; font-family: sans-serif">
                <div style="color: #ffffff; padding: 1rem 0; text-align: center;">
                    <h1>{$title}</h1>
                </div>

                {$slot}

                <div style="padding: 1rem; background: #1E3E87; margin-top: 20px; color: #ffffff; text-align: center;">
                    <p>{$copy}</p>
                </div>
            </body>
            </html>
        EOT;
    }
}
