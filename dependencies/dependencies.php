<?php

use App\lib\Login;
use App\service\UserService;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Slim\Flash\Messages;
use Slim\Views\Twig;
use Twig\Extra\Intl\IntlExtension;

//Add Dependencies Here
return array(

    'view' => function (ContainerInterface $c) {

        $twig = Twig::create('/', ['cache' => false, 'debug' => true]);
        $twig->addExtension(new \Twig\Extension\DebugExtension());
        $twig->addExtension(new IntlExtension());
        $twig->getEnvironment()->getExtension(\Twig\Extension\CoreExtension::class)->setTimezone('Asia/Manila');

        $twig->getEnvironment()->addGlobal('error',$c->get(\Slim\Flash\Messages::class)->getFirstMessage('error'));

        return $twig;
    },

    UserService::class => function (ContainerInterface $container) {
        return new UserService($container->get(EntityManager::class));
    },

    Messages::class => function () {
        return new Messages();
    },

);