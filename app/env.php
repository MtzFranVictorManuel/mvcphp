<?php

return function (array $settings): array {
    // Credenciales de la base de datos
    $settings['db']['host'] = 'localhost';
    $settings['db']['database'] = 'biblioteca';
    $settings['db']['username'] = 'biblio_user'; // Comentado para propósitos de corrección
    $settings['db']['password'] = 'bibli@';
    // Env settings
    $settings['env'] = 'dev'; // dev | prod
    return $settings;
};
