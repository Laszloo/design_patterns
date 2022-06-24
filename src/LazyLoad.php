<?php

class User
{
    private $id;
    private $name;
    private $email;
    private $transactions;

    public function __construct($id, $name, $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        // $this->transactions = TransactionRepo::getAll();
    }

    public function getId():int{
        return $this->id;
    }
    public function getName():int{
        return $this->id;
    }
    public function getEmail():int{
        return $this->id;
    }
    public function getTransactions():Array{
        ### LAZY LOAD START
        if (!$this->transactions) {
            $this->transactions = TransactionRepo::getAll();
        }
        ### LAZY LOAD END
        return $this->transactions;
    }
}

final class Transaction
{
    private $id;
    private $to;
    private $price;
    private $date;

    public function __construct($id, $to, $price, $date)
    {
        $this->id = $id;
        $this->to = $to;
        $this->price = $price;
        $this->date = $date;
    }

    public function getId():int{
        return $this->id;
    }
    public function getTo():string{
        return $this->to;
    }
    public function getPrice():int{
        return $this->price;
    }
    public function getDate():\DateTime{
        return $this->date;
    }
}

class TransactionRepo
{
    static public function getAll(): Array{
        $transactions = [];
        for ($i=0; $i < 100; $i++) { 
            $transactions[] = new Transaction(uniqid(), md5(time()), rand(100, 300000), (new DateTime('now')));
            usleep(10000);
        }
        return $transactions;
    }
}


$start = microtime(true);

$users[] = new User("1", "Peter", "info@peter.hu");
$users[] = new User("2", "Zoltan", "info@xyz.hu");
$users[] = new User("3", "Gabor", "info@stz.hu");
$users[] = new User("4", "Frank", "info@onmy.hu");
$users[] = new User("5", "Peter", "info@faboook.hu");

foreach ($users as $key => $value) {
    echo " id:".$value->getId() ." name:". $value->getName() ." email:". $value->getEmail(). PHP_EOL;
    // echo count($value->getTransactions()).PHP_EOL;
}

$stop = microtime(true);


echo ($stop-$start). " sec".PHP_EOL;