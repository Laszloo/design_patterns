<?php

class Order {
    private String $invoiceId;
    /** ... */
    public function __construct(String $invoiceId) {
        $this->invoiceId = $invoiceId;
    }
}

class WishList {
    private Int $userId;
    private Int $productId;

    public function __construct(int $userId, int $productId) {
        $this->userId = $userId;
        $this->productId = $productId;
    }
}

class User {
    private Int $id;
    private String $mail;
    /** ... */
    private array $orders;
    private array $whislist;

    public function __construct(int $id, string $mail, array $orders = [], array $whislist = []) {
        $this->id = $id;
        $this->mail = $mail;
    }

    public function getId(): Int {
        return $this->id;
    }
    public function getMail(): String {
        return $this->mail;
    }
    public function getOrders(): array {
        return $this->orders;
    }
    public function getWhislist(): array {
        return $this->whislist;
    }
}

class DB {
    public function queryWhislist($id): array {
        return [
            [
                "userId" => 1,
                "productId" => 2
            ],
            [
                "userId" => 1,
                "productId" => 3
            ],
            [
                "userId" => 1,
                "productId" => 4
            ],
        ];
    }

    public function queryAllOrder($id): array {
        return [
            [
                "invoiceId" => "2022-BL-120",
            ],
            [
                "invoiceId" => "2022-BL-132",
            ],
            [
                "invoiceId" => "2022-BL-146",
            ]
        ];
    }
}

interface UserProxyInterface {
    public function getId(): Int;
    public function getMail(): String;
    public function getOrders(): array;
    public function getWhislist(): array;
}

class UserProxy implements UserProxyInterface {
    private User $user;
    private array $orders;
    private array $whislist;
    private DB $db;

    public function __construct(User $user, DB $db) {
        $this->user = $user;
        $this->db = $db;
    }

    public function getId(): Int {
        return $this->user->getId();
    }
    public function getMail(): String {
        return $this->user->getMail();
    }
    public function getOrders(): array {
        if (empty($this->orders)) {
            $this->orders = array_map(function ($row) {
                return new Order($row["invoiceId"]);
            }, $this->db->queryAllOrder($this->getId()));
        }
        return $this->orders ?? [];
    }
    public function getWhislist(): array {
        if (empty($this->whislist)) {
            $this->whislist = array_map(function ($row) {
                return new WishList($row["userId"], $row["productId"]);
            }, $this->db->queryWhislist($this->getId()));
        }
        return $this->whislist ?? [];
    }
}


class UserRepository{
    private $db;

    public function __construct(DB $db)
    {
        $this->db = $db;
    }

    /**
     * @param int $userId
     * @return UserProxy $singleScaralResult
     */
    public function getUserById(int $userId){
        return new UserProxy((new User(1, "laszloo@github.com")), $this->db);
    }
}

$user = new UserRepository(new DB);

echo $user->getUserById(1)->getId() . PHP_EOL;
echo $user->getUserById(1)->getMail() . PHP_EOL;
var_dump($user->getUserById(1)->getWhislist()); echo PHP_EOL;
var_dump($user->getUserById(1)->getOrders()); echo PHP_EOL;