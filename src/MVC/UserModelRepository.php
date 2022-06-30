<?php

namespace App\MVC;

class UserModelRepository {
    private $users = [];
    private $modelClass;
    public function __construct(String $userModelClass) {
        $this->modelClass = $userModelClass;
        $this->users = [
            [
                "id" => 1,
                "name" => "Thomas Jack",
                "email" => "info@thomas.org"
            ],
            [
                "id" => 2,
                "name" => "Lisa Mer",
                "email" => "liz@comany.org"
            ],
            [
                "id" => 3,
                "name" => "Susanne Fox",
                "email" => "foxy@photographer.org"
            ],
        ];
    }

    public function findAll() {
        return array_map(function ($user) {
            return (new $this->modelClass())
                ->setId($user["id"])
                ->setName($user["name"])
                ->setEmail($user["email"]);
        }, $this->users);
    }
}
