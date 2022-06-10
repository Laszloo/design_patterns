<?php
namespace App;

class Singleton {
    private static $instance;

    private function __construct() {
    }

    static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}