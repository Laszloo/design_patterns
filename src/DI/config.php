<?php

use App\DI\Request;
use App\DI\RequestInterface;
use App\DI\Router;
use App\DI\RouterInterface;
use App\DI\DependencyInjection as DILocator;
use App\DI\User;
use App\DI\UserController;
use App\DI\UserRepository;

return function (DILocator $dILocator) {
    $dILocator->put(UserRepository::class, new UserRepository())
        ->put(User::class, function (DILocator $dILocator) {
            $s = $dILocator->get(UserRepository::class);
            return (new User($s));
        })
        ->put(UserController::class, function (DILocator $dILocator) {
            return new UserController($dILocator->get(User::class));
        });

    $dILocator->put(RequestInterface::class, new Request())
        ->put(RouterInterface::class, new Router());
};
