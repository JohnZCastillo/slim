<?php

global $twig;

use App\controller\auth\Authenticate;
use App\controller\auth\LoginPage;
use App\controller\user\homepage\homepage;
use Slim\App;

return function (App $app) use($twig){

    $app->get('/',Homepage::class);
    $app->get('/login',LoginPage::class);
    $app->post('/login',Authenticate::class);

};