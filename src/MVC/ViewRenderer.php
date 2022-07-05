<?php 


namespace App\MVC;


class ViewRenderer
{
    public function render(View $view){
        ob_clean();
        extract($view->getData());
        require __DIR__.DIRECTORY_SEPARATOR."templates".DIRECTORY_SEPARATOR.$view->getName().".phtml";
        ob_end_flush();
    }
}
