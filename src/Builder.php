<?php

namespace App;


final class Builder {
    private int $id;
    private \DateTime $date;
    private int $customerId;
    private string $comment;
    private string $group;
    private int $administratorId;

    public function __construct(TransactionBuilder $transactionBuilder) {
       $this->id = $transactionBuilder->getId();
       $this->date = $transactionBuilder->getDate();
       $this->customerId = $transactionBuilder->getCustomerId();
       $this->comment = $transactionBuilder->getComment();
       $this->group = $transactionBuilder->getGroup();
       $this->administratorId = $transactionBuilder->getAdministratorId();
    }

    public function getId(): int {
        return $this->id;
    }
    public function getDate(): \DateTime {
        return $this->date;
    }
    public function getCustomerId(): int {
        return $this->customerId;
    }
    public function getComment(): string {
        return $this->comment;
    }
    public function getGroup(): string {
        return $this->group;
    }
    public function getAdministratorId(): int {
        return $this->administratorId;
    }

    static function getBuilder(): TransactionBuilder {
        return new TransactionBuilder();
    }
}


class TransactionBuilder {
    private int $id;
    private \DateTime $date;
    private int $customerId;
    private string $comment;
    private string $group;
    private int $administratorId;


    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
        return $this;
    }
    public function getDate() {
        return $this->date;
    }
    public function setDate($date) {
        $this->date = $date;
        return $this;
    }
    public function getCustomerId() {
        return $this->customerId;
    }
    public function setCustomerId($customerId) {
        $this->customerId = $customerId;
        return $this;
    }
    public function getComment() {
        return $this->comment;
    }
    public function setComment($comment) {
        $this->comment = $comment;
        return $this;
    }
    public function getGroup() {
        return $this->group;
    }

    public function setGroup($group) {
        $this->group = $group;
        return $this;
    }
    public function getAdministratorId() {
        return $this->administratorId;
    }
    public function setAdministratorId($administratorId) {
        $this->administratorId = $administratorId;
        return $this;
    }

    public function build(){
        return new Builder($this);
    }

}