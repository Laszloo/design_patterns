<?php

use App\Bottle;
use App\Factory;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    private Factory $testTarget;

    public function setUp():void
    {
        /**
         * @var Factory
         */
        $this->testTarget = new Factory();
    }

    /**
     * @test
     */
    public function it_should_return_a_bottle_type_object(){
        //GIVEN
        //WHEN
        $product = $this->testTarget->getProduct(Bottle::class);
        //THEN
        $this->assertEquals(get_class($product), Bottle::class);
    }

    /**
     * @test
     */
    public function these_objects_cannot_be_same(){
        //GIVEN
        //WHEN
        $product = $this->testTarget->getProduct(Bottle::class);
        $product2 = $this->testTarget->getProduct(Bottle::class);
        //THEN
        $this->assertNotSame($product, $product2);
    }
}
