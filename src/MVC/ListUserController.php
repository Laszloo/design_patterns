<?php

namespace App\MVC;

class ListUserController {
    public function list(UserModelRepository $userModelRepository) {

        //business logic
        return new View(
            "user",
            [
                "users" => $userModelRepository->findAll(),
                "title" => "List of all users"
            ]
        );
    }
}
