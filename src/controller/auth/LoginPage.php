<?php

namespace App\controller\auth;

use App\controller\UserAction;
use Psr\Http\Message\ResponseInterface as Response;

class LoginPage extends UserAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {

        return $this->view('/login.html',[]);
    }
}