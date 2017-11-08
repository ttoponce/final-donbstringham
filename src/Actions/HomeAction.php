<?php

namespace App\Actions;

use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;


final class HomeAction
{
    protected $view;
    protected $log;

    public function __construct(Twig $view, LoggerInterface $logger)
    {
        $this->view = $view;
        $this->log = $logger;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $this->log->info("Homepage action dispatched");

        return $this->view->render($response, 'index.html.twig', []);
    }
}
