<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

namespace App;

interface Product {
    public function setId(int $id): self;
    public function setPrice(int $price): self;
    public function setWeight(int $weight): self;

    public function getId(): int;
    public function getPrice(): int;
    public function getWeight(): int;
}

class Bottle implements Product {
    private $id;
    private $price;
    private $weight;

    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }
    public function setPrice(int $price): self {
        $this->price = $price;
        return $this;
    }
    public function setWeight(int $weight): self {
        $this->weight = $weight;
        return $this;
    }

    public function getId(): int {
        return $this->id;
    }
    public function getPrice(): int {
        return $this->price;
    }
    public function getWeight(): int {
        return $this->weight;
    }
}



class Factory {
    public function getProduct(String $class): Product {
        $class = new $class();
        $product = new $class();
        return $product;
    }
}
