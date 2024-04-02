<?php
namespace App\Controllers;
use eftec\bladeone\BladeOne;
class BaseController {
    public function render($view,$data=[]){
        $viewDir= "./app/views";
        $cache= "./storage";
        $blade = new BladeOne($viewDir, $cache,BladeOne::MODE_DEBUG);
        echo  $blade->run($view,$data);
    }
}
