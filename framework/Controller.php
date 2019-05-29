<?php
/**
 * Created by PhpStorm.
 * User: fivium
 * Date: 29/05/19
 * Time: 8:20 AM
 */

abstract class Controller
{

  protected $viewFolder;

    public function render($view,$param = null){

        $file_name = __DIR__.'/../view/'.(isset($this->viewFolder)?$this->viewFolder.'/':'').$view.'.php';
        ob_start();
        if (isset($param)){
            extract($param, EXTR_SKIP);
        }
        include($file_name);
        $content=ob_get_contents();
        ob_end_clean();
        echo $content;
    }

    public function redirect($url){
        header("Location:".$url,true,302);
        exit();
    }
}
