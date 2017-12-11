<?php
/**
 * Application middleware
 */
$c = $app->getContainer();

$logger = $c->get('logger');
$usr_repo = $c->get(\App\Storage\UserRepository::class . 'Eloquent');
$sess = $c->get('session');

// Password authentication
$app->add(new \App\Middleware\PasswordAuthentication($logger, $sess, $usr_repo));

// Cookie authentication
//$app->add();
