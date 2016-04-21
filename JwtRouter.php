<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/JwtAuthenticationProvider.php';
require_once __DIR__ . '/ClientForSessionMeta.php';

use Thruway\Peer\Router;
use Thruway\Transport\RatchetTransportProvider;

$router = new Router();

$router->registerModule(new \Thruway\Authentication\AuthenticationManager());

$router->addInternalClient(new JwtAuthenticationProvider(['realm1'], 'example_key')); // CHANGE YOUR KEY

$router->addInternalClient(new ClientForSessionMeta('realm1', $router->getLoop()));

$transportProvider = new RatchetTransportProvider("127.0.0.1", 9090);

$router->addTransportProvider($transportProvider);

$router->start();
