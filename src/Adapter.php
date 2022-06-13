<?php 

namespace App;

interface MailerInterface{
    public function setFrom(String $string): self;
    public function setTo(String $string): self;
    public function setSubject(String $string): self;
    public function setBody(String $string): self;
    public function send(): bool;
}

class Swift_Mailer implements MailerInterface
{
    private $from, $to, $subject, $body;

    public function setFrom(String $string): self{
        $this->from = $string;
        return $this;
    }
    public function setTo(String $string): self{
        $this->to = $string;
        return $this;
    }
    public function setSubject(String $string): self{
        $this->subject = $string;
        return $this;
    }
    public function setBody(String $string): self{
        $this->body = $string;
        return $this;
    }
    public function send(): bool{
        echo "OK by Swift";
        return true;
    }
}

class Mailer{
    public function message($from, $to, $subject, $body)
    {
        //immediately sends
        echo "OK by Mailer";
    }
}

class Adapter extends Mailer implements MailerInterface
{
    private $from, $to, $subject, $body;

    public function setFrom(String $string): self{
        $this->from = $string;
        return $this;
    }
    public function setTo(String $string): self{
        $this->to = $string;
        return $this;
    }
    public function setSubject(String $string): self{
        $this->subject = $string;
        return $this;
    }
    public function setBody(String $string): self{
        $this->body = $string;
        return $this;
    }
    public function send(): bool{
        $this->message($this->from, $this->to, $this->subject, $this->body);
        return true;
    }
}


class Response{}

class RegistrationController
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
    $this->mailer = $mailer;
    }

    public function index(){
        #.. code

        $this->mailer->setTo("info@xy.hu")
        ->setFrom("info@zz.hu")
        ->setSubject("Successful registration!")
        ->setBody("Lorem ipsum dolores...")
        ->send();

        return new Response();
    }
}

?>