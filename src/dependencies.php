<?php
/**
 * DIC configuration
 *
 * @category CS4350
 * @package  Src
 * @author  Don B. Stringham <donstringham@weber.edu>
 * @license  MIT http://mit.org
 * @link  http://weber.edu
 */

$container = $app->getContainer();

// view
$container['view'] = function ($c) {
    $settings = $c->get('settings'); $view = new \Slim\Views\Twig($settings['view']['template_path'], $settings['view']['twig']);
    // Add extensions
    $view->addExtension(new \Slim\Views\TwigExtension($c->get('router'), $c->get('request')->getUri()));
    $view->addExtension(new \Twig_Extension_Debug());

    return $view;
};

// flash messages
$container['flash'] = function ($c) {
    return new \Slim\Flash\Messages;
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new \Monolog\Logger($settings['name']);
    $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
    $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));

    return $logger;
};

// database
$container['db'] = function ($c) {
    $capsule = new \Illuminate\Database\Capsule\Manager;

    $capsule->addConnection($c->get('settings')['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();

    return $capsule;
};

// error handlers
$container['errorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        $c->get('logger')->error($exception->getMessage());
        $response->getBody()->rewind();
        return $response->withStatus(500)
                        ->withHeader('Content-Type', 'text/html')
                        ->write("<hr>Oops, something's gone wrong!<hr>");
    };
};

$container['phpErrorHandler'] = function ($c) {
    return function ($request, $response, $exception) use ($c) {
        $c->get('logger')->error($exception->getMessage());
        $response->getBody()->rewind();
        return $response->withStatus(500)
                        ->withHeader('Content-Type', 'text/html')
                        ->write("Oops, something's gone wrong!");
    };
};

// Register globally to app
$container['session'] = function ($c) {
    $s = new \App\Storage\Session();
    return $s::init(new \App\Storage\PhpSessionAdapter());
};

$container['mock-session'] = function ($c) {
    $s = new \App\Storage\Session();
    return $s::init(new \App\Storage\MemSessionAdapter());
};

$container['slim-session'] = function ($c) {
    $s = new \App\Storage\Session();
    return $s::init(new \App\Storage\SlimSessionAdapter());
};

// classes/objects
$container[\App\Actions\HomeAction::class] = function ($c) {
    return new \App\Actions\HomeAction($c->get('view'), $c->get('logger'));
};

$container[\App\Actions\ProfileAction::class] = function ($c) {
    $view = $c->get('view');
    $logger = $c->get('logger');
    $table = $c->get('db')->table('users');

    return new \App\Actions\ProfileAction($view, $logger, $table);
};

$container[\App\Storage\MemoryPlugin::class] = function ($c) {
    return new \App\Storage\MemoryPlugin();
};

$container[\App\Storage\UserRepository::class . 'Eloquent'] = function ($c) {
    $builder = $c->get('db')->table('users');
    $adapter = new \App\Storage\EloquentPlugin($builder);

    return new \App\Storage\UserRepository($adapter);
};

$container[\App\Storage\UserRepository::class . 'Mem'] = function ($c) {
    $adapter = $c->get(\App\Storage\MemoryPlugin::class);

    return new \App\Storage\UserRepository($adapter);
};
