<?php 


namespace App\MVC;


class ViewRenderer
{
    public function render(View $view){

        extract($view->getData());
        require __DIR__.DIRECTORY_SEPARATOR."templates".DIRECTORY_SEPARATOR.$view->getName().".phtml";
    }
}
