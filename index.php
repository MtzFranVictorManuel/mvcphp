<?php

use DI\Container;
use Psr\Container\ContainerInterface;
use App\Settings\Settings;
use App\Data\DataContext;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;

require __DIR__ . '/vendor/autoload.php';


// Crea la aplicación.
// Crea el Container de la aplicación usando PHP-DI
$container = new Container();

// Agregamos el servicio de settings de la app desde la clase Settings
$container->set('settings', function () {
    // Carga los settings desde un archivo
    $settings = require __DIR__ . '/app/settings.php';
    return new Settings($settings);
});

// Agregamos el servicio motor Twig
$container->set('view', function() {
    return Twig::create('src/Views/', ['cache' => false]);
});

// Agregamos el servicio de contexto de db
$container->set('db', function (ContainerInterface $container) {
    return new DataContext($container->get('settings')->get());
});

// Configura la aplicación via container
$app = AppFactory::createFromContainer($container);

// Routing middleware para el manejo de las rutas
$app->addRoutingMiddleware();

// Define app routes
$routes = require __DIR__ . '/app/routes.php';
$routes($app);

// Error Middleware para el manejo de errores
$app->addErrorMiddleware(true, true, true);

// Ejecuta la aplicación
$app->run();



