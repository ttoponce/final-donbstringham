<?php

namespace App\Actions;

use InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Illuminate\Database\Query\Builder;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

class LoginAction
{

    public function __construct(Twig $view, LoggerInterface $logger, Builder $table)
    {
        $this->view = $view;
        $this->log = $logger;
        $this->table = $table;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        // After user has been validated as authorized
        session_start();
        $_SESSION['u_uuid'] = uniqid('usr_', true);
        $_SESSION['u_username'] = 'some@example.com';
    }

}
