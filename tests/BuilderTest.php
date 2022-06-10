<?php

use App\Builder;
use App\TransactionBuilder;

class BuilderTest extends PHPUnit\Framework\TestCase {
    private $targetClass, $builderTransaction;

    /**
     * Over ride TestCase::setUp fn
     *
     * @return void
     */
    public function setUp(): void {
        $this->targetClass = Builder::class;
    }

     /**
     * @test
     */
    public function it_should_return_transaction_builder_object() {
        //GIVEN        
        //WHEN
        $builder = Builder::getBuilder();
        //THEN
        $this->assertEquals(TransactionBuilder::class, get_class($builder));
    }

    /**
     * @test
     */
    public function it_should_return_builder_object() {
        //GIVEN
        $builder = Builder::getBuilder()
            ->setId(1)
            ->setCustomerId(9)
            ->setGroup("aa")
            ->setDate(new \DateTime('now'))
            ->setComment("none")
            ->setAdministratorId(10);
        
        //WHEN
        $actual = $builder->build();
        //THEN
        $this->assertEquals($this->targetClass, get_class($actual));
    }

    /**
     * @test
     */
    public function it_should_return_two_builder_object_and_dont_same_each_other() {
        //GIVEN
        $builder = Builder::getBuilder()
            ->setId(1)
            ->setCustomerId(9)
            ->setGroup("aa")
            ->setDate(new \DateTime('now'))
            ->setComment("none")
            ->setAdministratorId(10);
        
        //WHEN
        $actual = $builder->build();
        $actual2 = $builder->build();
        //THEN
        $this->assertNotSame($actual, $actual2);
    }

   
}
