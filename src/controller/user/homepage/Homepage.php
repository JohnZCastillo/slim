<?php

namespace App\controller\user\homepage;

use App\controller\UserAction;
use Psr\Http\Message\ResponseInterface as Response;

class Homepage extends UserAction
{
    protected function action(): Response
    {

        return  $this->redirect('/login');

    }
}