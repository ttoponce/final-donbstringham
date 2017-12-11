<?php

namespace App\Actions;

use InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Illuminate\Database\Query\Builder;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Views\Twig;

class ProfileAction
{
    protected $view;
    protected $log;
    protected $table;

    public function __construct(Twig $view, LoggerInterface $logger, Builder $table)
    {
        $this->view = $view;
        $this->log = $logger;
        $this->table = $table;
    }

    public function __invoke(Request $request, Response $response, array $args)
    {
        $this->log->info("Profilepage action dispatched");

        $args = $request->getParsedBody();

        if (!filter_var($args['f_username'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException($args['f_username'] . ' is invalid');
        }

        $user = $this->table->where('email', $args['f_username'])->first();

        // No user in the database with this username
        if ($user === null || empty($user)) {
            return $this->view->render($response, 'profile.html.twig', []);
        }

        // Password check
        if ($user->password !== $args['f_password']) {
            return $this->view->render($response, 'profile.html.twig', []);
        }

        return $this->view->render($response, 'profile.html.twig', ['name' => $user->name]);
    }
}
