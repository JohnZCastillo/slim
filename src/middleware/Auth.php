<?php

namespace App\middleware;

use App\lib\Login;
use App\service\UserService;
use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Flash\Messages;
use Slim\Psr7\Response;

class Auth
{
    private UserService $userService;

    protected Messages $messages;

    public function __construct(UserService $userService, Messages $messages)
    {
        $this->userService = $userService;
        $this->messages = $messages;
    }

    public function __invoke(Request $request, RequestHandler $handler): ResponseInterface
    {

        $location = '/login';

        try {

            if (!Login::isLogin()) {
                throw new \Exception('You Must Login First');
            }

            return $handler->handle($request);

        } catch (Exception $exception) {
            Login::forceLogout('slimFlash');
            $this->messages->addMessage('loginError',$exception->getMessage());
        }

        $response = new Response();
        return $response->withHeader('Location', $location)->withStatus(302);
    }
}