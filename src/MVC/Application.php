<?php 

namespace App\MVC;

class Application
{
    private $viewRenderer;

    public function __construct(ViewRenderer $viewRenderer)
    {
        $this->viewRenderer = $viewRenderer;
        //D.I. service, config, etc...
    }

    public function start(){
        //router config
        //and then router return the next view:
        $view = (new ListUserController())->list(new UserModelRepository(UserModel::class));
        $this->viewRenderer->render($view);
    }
}



?>