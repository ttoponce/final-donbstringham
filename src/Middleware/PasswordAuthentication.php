<?php
/**
 * Created by PhpStorm.
 * User: stringhamdb
 * Date: 11/27/17
 * Time: 6:23 PM
 */

namespace App\Middleware;

use App\Storage\EloquentPlugin;
use App\Storage\UserRepository;

class PasswordAuthentication
{
    /** @var $container \Slim\Container */
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * @param  \Psr\Http\Message\ServerRequestInterface $request PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface $response PSR7 response
     * @param  callable $next Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function __invoke($request, $response, $next)
    {
        /** @var \Monolog\Logger $log */
        $log = $this->container->get('logger');
        if ($request->getMethod() !== 'POST') {
            $log->critical('$request is NOT a POST');
            $response = $next($request, $response);
        }
        $parsedBody = $request->getParsedBody();
        $formPassword = $parsedBody['f_password'];
        $formUsername = $parsedBody['f_username'];
        /** @var \App\Storage\UserRepository $repo */
        $repo = $this->container->get(UserRepository::class.'Eloquent');
        $user = $repo->Find($formUsername);
        // TODO: If no user, display error message to user
        // TODO: Compare form password to DB user password
        // TODO: If no match, display error message to user
        // TODO: Create session
        // TODO: Store user object in session

        return $response;
    }
}