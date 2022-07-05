<?php

namespace App;

use InvalidArgumentException;

class ServiceLocator {
    private $container = [];
    private static $instance;

    private function __construct() {
    }

    static public function getInstance(): self {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function put(String $serviceName, $service): self {
        if (!is_object($service) && !is_callable($service)) {
            throw new InvalidArgumentException("Service must be callable or object");
        }
        $this->container[$serviceName] = $service;
        return $this;
    }

    public function get(String $serviceName) {
        if (!array_key_exists($serviceName, $this->container)) {
            throw new InvalidArgumentException("This service is not found");
        }
        $service = $this->container[$serviceName];

        if (is_callable($service)) {
            $this->container[$serviceName] = $service = $service($this);
            return $service;
        }
        if (is_object($service)) {
            $this->container[$serviceName] = $service = new $service;
            return $service;
        }
    }
}


class UserController {
    private User $user;
    public function __construct(User $user) {
        $this->user = $user;
    }
    public function register() {
        $this->user->newUser();
    }
}

class User {
    private UserRepository $userRepository;
    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }
    public function newUser() {
        $this->userRepository->create();
    }
}

class UserRepository {
    public function create() {
        echo "Create a User!" . PHP_EOL;
    }
}


$locator = ServiceLocator::getInstance()
    ->put(UserRepository::class, new UserRepository())
    ->put(User::class, function (ServiceLocator $serviceLocator) {
        $s = $serviceLocator->get(UserRepository::class);
        return (new User($s));
    })
    ->put(UserController::class, function (ServiceLocator $serviceLocator) {
        return new UserController($serviceLocator->get(User::class));
    });


$controller = $locator->get(User::class);
$controller->register();
