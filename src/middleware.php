<?php
/**
 * Application middleware
 */

$c = $app->getContainer();
try {
    $logger = $c->get('logger');
} catch (\Psr\Container\NotFoundExceptionInterface $e) {
} catch (\Psr\Container\ContainerExceptionInterface $e) {
}

try {
    $usr_repo = $c->get(App\Storage\UserRepository::class . 'Eloquent');
} catch (\Psr\Container\NotFoundExceptionInterface $e) {
} catch (\Psr\Container\ContainerExceptionInterface $e) {
}
// Password authentication
$app->add(new \App\Middleware\PasswordAuthentication($logger, new \SlimSession\Helper(), $usr_repo));

// Cookie authentication
//$app->add();
