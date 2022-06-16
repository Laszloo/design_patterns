<?php

namespace App;

interface Counter {
    public function setTarget(int $number): self;
    public function getValues(): array;
}

class PrimCounter implements Counter {
    private $target;
    public function setTarget(int $number): self {
        $this->target = $number;
        return $this;
    }
    public function getValues(): array {
        $n = 0;
        for ($i = 2; $i < $this->target + 1; $i++) {
            if ($this->primenumber($i)) {
                $array[] = $this->primenumber($i);
                sleep(1);
            }
        }

        return $array;
    }

    private function primenumber($target) {
        $n = 0;
      
        for($i = 2; $i < ($target/2+1); $i++) {
          if($target % $i == 0){
            $n++;
            break;
          }
        }
      
        if ($n == 0){
          return $target;
        } 
      }
}



abstract class AbstractCache
{
    private Array $cache = [];

    public function put($key, $value)
    {
        $this->cache[$key] = $value;
    }

    public function has($key)
    {
        return array_key_exists($key, $this->cache);
    }

    public function get($key)
    {
        return $this->cache[$key];
    }
}

class Decorator extends AbstractCache implements Counter
{
    private $primCounter, $target;

    public function __construct(Counter $primCounter) {
        $this->primCounter = $primCounter;
    }
    public function setTarget(int $number): self{
        $this->target = $number;
        return $this;
    }
    public function getValues(): array{
        if (!$this->has($this->target)) {
            $values = $this->primCounter->setTarget($this->target)->getValues();
            $this->put($this->target, $values);
        }
        return $this->get($this->target);
    }
}