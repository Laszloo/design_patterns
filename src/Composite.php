<?php 
namespace App;


class Request
{
    private $data;
    
    public function getData()
    {
        return $this->data;
    }

    public function setData($data){
        $this->data = $data;
    }
}


class OrderController
{
   public function index(Request $request, Composite $requestValidator)
   {
        if ($requestValidator->validate($request)) {
            echo "ok";
            return true;
        }   
        echo "Oops";
        return false;
   }
}




interface Validator{
    public function validate(Request $request): bool;
}


class Composite implements Validator
{
    /**
     * @var Array<Validator>
     */
    private $validators = [];

    public function validate(Request $request): bool
    {
        $bool = true;
        foreach ($this->validators as $value) {
            if (!$value->validate($request)) {
                $bool = false;
                break;
            }
        }
        return $bool;
    }

    public function add(Validator $validator):self{
        $this->validators[] = $validator;
        return $this;
    }
}


class EmailRequestValidator implements Validator
{
    public function validate(Request $request): bool
    {
        #...code
        return true;
    }
}

class EmptyRequestValidator implements Validator
{
    public function validate(Request $request): bool
    {
        #...code
        return false;
    }
}

class LengthRequestValdiator implements Validator
{
    public function validate(Request $request): bool
    {
        #...code
        return true;
    }
}


#########

$requestValidator = (new Composite())->add((new EmailRequestValidator()))->add((new EmptyRequestValidator()))->add((new LengthRequestValdiator()));

(new OrderController())->index((new Request()), $requestValidator);

?>