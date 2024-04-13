<?php

namespace App\controller;

use App\service\UserService;
use Slim\Flash\Messages;

abstract class UserAction extends  Action
{

   protected UserService $userService;
   protected Messages $messages;

    /**
     * @param UserService $userService
     * @param Messages $messages
     */
    public function __construct(UserService $userService, Messages $messages)
    {
        $this->userService = $userService;
        $this->messages = $messages;
    }

}