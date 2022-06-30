<?php

namespace App\MVC;

class View {
    private string $name;
    private array $data;

    public function __construct(String $name, array $array) {
        $this->name = $name;
        $this->data = $array;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getData(): array {
        return $this->data;
    }
}
