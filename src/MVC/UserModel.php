<?php

namespace App\MVC;

class UserModel {
    private int $id;
    private string $name;
    private string $email;

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName(String $name): self {
        $this->name = $name;
        return $this;
    }


    public function getEmail(): string {
        return $this->email;
    }


    public function setEmail(String $email): self {
        $this->email = $email;
        return $this;
    }
}
