<?php 

namespace App;

interface Base{
    public function setColor(String $color): self;
    public function getCoord():Array;
    /** ETC. */
}


class Shape{
    protected Base $base;

    public function __construct(Base $base)
    {
        $this->base = $base;
    }

    public function drawThis(){
        echo "Coordinates of this shape: ".$this->draw($this->base->getCoord());
    }

    protected function draw(Array $array) :string{
        $string = "";
        foreach ($array as $key => $value) {
            $string .= "[".implode(", ", $value)."] ";
        }
        $string.=PHP_EOL;
        return $string;
    }
}

class ShapeExtended extends Shape{
    public function drawThisMirroring()
    {
        $arr = $this->base->getCoord();
        foreach ($arr as $key => $value) {
            foreach ($value as $k => $v) {
                $value[$k] = $v * -1;
            }
            $arr[$key] = $value;
        }
        echo "Coordinates of this shape (mirrored): ".$this->draw($arr);
    }
}

##########

class Dot implements Base{
    private $color;
    private Array $arr = [];

    public function setColor(String $color): self{
        $this->color = $color;
        return $this;
    }

    public function setCoord(int $x, int $y):self{
        $this->arr = [];
        $this->arr[] = [$x, $y];
        return $this;
    }

    public function getCoord(): Array{
        return $this->arr;
    }
}

class Line implements Base{
    private $color;
    private Array $arr = [];
    const MAX_LENGTH = 2;

    public function setColor(String $color): self{
        $this->color = $color;
        return $this;
    }

    public function addCoord(int $x, int $y):self{
        if (count($this->arr) >= self::MAX_LENGTH) {
            unset($this->arr[0]);
        }
        $this->arr[] = [$x, $y];
        return $this;
    }

    public function getCoord(): Array{
        return $this->arr;
    }
}

##########

// $l = (new Dot())->setColor("Black")->setCoord(2, -3);
$l = (new Line())->setColor("Red")->addCoord(1, 1)->addCoord(3, 3)->addCoord(4,4);
$shape = new Shape($l);
$shapeex = new ShapeExtended($l);
$shape->drawThis();
$shapeex->drawThisMirroring();
