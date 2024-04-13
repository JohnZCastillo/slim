<?php

namespace App\controller\auth;

use App\controller\UserAction;
use Psr\Http\Message\ResponseInterface as Response;

class Authenticate extends UserAction
{

    /**
     * @inheritDoc
     */
    protected function action(): Response
    {

        $username = $this->getFormData()['username'];
        $password = $this->getFormData()['password'];

        if($username != 'admin' && $password != 'admin'){
            $this->messages->addMessage('error','Incorrect Username/Password');
            return $this->redirect('/login');
        }

        return $this->redirect('/');

    }


}