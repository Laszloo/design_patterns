<?php

use App\Adapter;
use App\RegistrationController;
use App\Response;
use App\Swift_Mailer;
use PHPUnit\Framework\TestCase;

class AdapterTest extends TestCase
{
    private $underTest;

    public function setUp():void{
        // $this->underTest = new RegistrationController();
    }

    /**
     * @test
     */
    public function check_all_function_calls_of_adapter_class(){
        //GIVEN
        $adapter = $this->createMock(Adapter::class);
        $adapter->expects($this->once())->method("setFrom")->willReturn($adapter);
        $adapter->expects($this->once())->method("setTo")->willReturn($adapter);
        $adapter->expects($this->once())->method("setSubject")->willReturn($adapter);
        $adapter->expects($this->once())->method("setBody")->willReturn($adapter);
        $adapter->expects($this->once())->method("send")->willReturn(true);
        $reg = new RegistrationController($adapter);
        //WHEN
        $return = $reg->index();
        //THEN
        $this->assertEquals($return, (new Response()));
    }

    /**
     * @test
     */
    public function check_all_function_calls_of_swift_class(){
        //GIVEN
        $adapter = $this->createMock(Swift_Mailer::class);
        $adapter->expects($this->once())->method("setFrom")->willReturn($adapter);
        $adapter->expects($this->once())->method("setTo")->willReturn($adapter);
        $adapter->expects($this->once())->method("setSubject")->willReturn($adapter);
        $adapter->expects($this->once())->method("setBody")->willReturn($adapter);
        $adapter->expects($this->once())->method("send")->willReturn(true);
        $reg = new RegistrationController($adapter);
        //WHEN
        $return = $reg->index();
        //THEN
        $this->assertEquals($return, (new Response()));
    }
}


?>