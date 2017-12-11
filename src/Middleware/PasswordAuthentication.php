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
    /** @var $log \Monolog\Logger */
    protected $log;
    /** @var \App\Storage\UserRepository $repo */
    protected $repo;
    /** @var \App\Storage\SessionAdapter $sess */
    protected $sess;

    public function __construct($logger, $session, $repository)
    {
        $this->log = $logger;
        $this->sess = $session;
        $this->repo = $repository;
    }

    /**
     * @param  \Psr\Http\Message\ServerRequestInterface $request PSR7 request
     * @param  \Psr\Http\Message\ResponseInterface $response PSR7 response
     * @param  callable $next Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \InvalidArgumentException
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function __invoke($request, $response, $next)
    {
        $this->log->info('*** BEGIN ' . __METHOD__);
        $userId = $this->sess->get('web4350_session');
        if($this->sess->exists('web4350_session')) {
            $this->log->info('*** IN ' . __METHOD__ . ' found session cookie?');
            $id = $this->sess->get('web4350_session');
            $this->log->info('looking for ' . $id);
            $user = $this->repo->Find($id);
            if (empty($user)) {
                // TODO: If user does NOT exist, destroy session, redirect to login/home
                $this->log->info('*** BEGIN ' . __METHOD__);
                return $response->withStatus(401);
            }
            $this->sess->set('usr', $user);
            $this->log->info('*** BEGIN ' . __METHOD__);
            return $next($request, $response);
        }
        if ($request->getMethod() !== 'POST') {
            $this->log->info('*** IN ' . __METHOD__ . ' is request a POST');
            $this->log->critical('$request is NOT a POST');
            $this->log->info('*** BEGIN ' . __METHOD__);
            return $next($request, $response);
        }
        $parsedBody = $request->getParsedBody();
        if ($parsedBody['f_password'] !== null && $parsedBody['f_username'] !== null) {
            $this->log->info('*** IN ' . __METHOD__ . ' looking for f_username');
            $formPassword = $parsedBody['f_password'];
            $formUsername = $parsedBody['f_username'];
            $this->log->info('looking for ' . $formUsername);
            $user = $this->repo->FindByUsername($formUsername);
            // TODO: If no user, display error message to user
            // TODO: Compare form password to DB user password
            // TODO: If no match, display error message to user
            // SEE: http://php.net/manual/en/function.session-start.php
            // SEE: https://www.sitepoint.com/community/t/phpunit-testing-cookies-and-sessions/36557/2
            $this->sess->set('usr', $user);
            $this->sess->set('web4350_session', $user->getID());
            $this->log->info('*** BEGIN ' . __METHOD__);
            return $next($request, $response);
        }

        $this->log->info('*** BEGIN ' . __METHOD__);
        return $response->withStatus(401);
    }
}
