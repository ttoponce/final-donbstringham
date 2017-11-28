<?php
// Application middleware

// e.g: $app->add(new \Slim\Csrf\Guard);

// Password authentication
$app->add(new \App\Middleware\PasswordAuthentication($app->getContainer()));

// Cookie authentication
$app->add();
