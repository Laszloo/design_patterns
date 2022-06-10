<?php

use App\Singleton;
use PHPUnit\Framework\TestCase;

class SingletonTest extends TestCase {

    private $underTest;

    public function setUp():void{
        $this->underTest = Singleton::getInstance();
    }

    /**
     * @test
     */
    public function it_should_return_true() {
        $this->assertEquals($this->underTest, Singleton::getInstance());
    }

    /**
     * @test
     */
    public function these_objects_cannot_be_same(){
        $clone = unserialize(serialize($this->underTest));
        $this->assertNotSame($this->underTest, $clone);
    }

    /**
     * @test
     */
    public function these_objects_are_equals_each_other(){
        $mock = serialize($this->underTest);
        $this->assertNotSame($this->underTest, unserialize($mock));
    }
}
