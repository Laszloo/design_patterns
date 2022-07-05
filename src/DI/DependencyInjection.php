<?php

namespace App\DI;

use InvalidArgumentException;

class DependencyInjection {
    private $container = [];

    public function __construct(callable $config) {
        $config($this);
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

interface RequestInterface {
}

interface RouterInterface {
}

class Request implements RequestInterface {
}

class Router  implements RouterInterface {
    public function route(RequestInterface $request) {
        return [
            UserController::class,
            "register"
        ];
    }
}



class Application {
    private DependencyInjection $container;
    private static $instance;

    private function __construct() {
    }

    public static function init(callable $config) {
        if (self::$instance == null) {
            self::$instance = new self;
            self::$instance->container = new DependencyInjection($config);
        }
        return self::$instance;
    }

    public function start() {
        $request = $this->container->get(RequestInterface::class);
        $router = $this->container->get(RouterInterface::class);
        list($controllerName, $methodName) = $router->route($request);
        $this->container->get($controllerName)->$methodName();
    }
}

Application::init(include __DIR__ . DIRECTORY_SEPARATOR . "config.php")->start();
